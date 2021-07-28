<?php

namespace {

    if (!extension_loaded("pthreads")) {
        /** TO BE IMPLEMENTED:
         * Collectable - DONE
         * IteratorAggregate - DONE
         * Countable - DONE
         * ArrayAccess - DONE
         * ThreadedInterface
         */
        class Threaded implements IteratorAggregate, Countable, ArrayAccess, ThreadedInterface
        {

            const NOTHING = (0);
            const STARTED = (1 << 0);
            const RUNNING = (1 << 1);
            const JOINED = (1 << 2);
            const ERROR = (1 << 3);

            protected array $idata = [];
            protected int $istate = THREAD::NOTHING;

            public function __setState($state): bool
            {
                $this->istate += $state;
                return true;
            }
            public function getState(): int
            {
                return $this->istate;
            }

            public function __set($offset, $value)
            {
                if ($offset === null) {
                    $offset = count($this->idata);
                }

                if (!$this instanceof Volatile) {
                    if (isset($this->idata[$offset]) &&
                        $this->idata[$offset] instanceof Threaded) {
                        throw new \RuntimeException();
                    }
                }

                if (is_array($value)) {
                    $safety =
                        new Volatile();
                    $safety->merge(
                        $this->convertToVolatile($value));
                    $value = $safety;
                }

                return $this->idata[$offset] = $value;
            }

            public function __get($offset)
            {
                echo $offset;
                return $this->idata[$offset];
            }

            public function __isset($offset)
            {
                return isset($this->idata[$offset]);
            }

            public function __unset($offset)
            {
                if (!$this instanceof Volatile) {
                    if (isset($this->idata[$offset]) && $this->idata[$offset] instanceof Threaded) {
                        throw new \RuntimeException();
                    }
                }
                unset($this->idata[$offset]);
            }

            private function convertToVolatile($value)
            {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        if (is_array($v)) {
                            $value[$k] =
                                new Volatile();
                            $value[$k]->merge(
                                $this->convertToVolatile($v));
                        }
                    }
                }
                return $value;
            }

            public function getIterator(): ArrayIterator
            {
                return new ArrayIterator($this->idata);
            }

            public function offsetExists($offset)
            {
                return $this->__isset($offset);
            }

            public function offsetGet($offset)
            {
                return $this->__get($offset);
            }

            public function offsetSet($offset, $value)
            {
                $this->__set($offset, $value);
            }

            public function offsetUnset($offset)
            {
                $this->__unset($offset);
            }

            public function chunk(int $size, bool $preserve = false): array
            {
                $return = [];
                $count = 0;

                foreach ($this->data as $k => $v) {
                    if ($count === $size) {
                        break;
                    }
                    $return[$k] = $v;
                    if (!$preserve) {
                        $this->__unset($k);
                    }
                    $count++;
                }

                return $return;
            }

            public function count(): int
            {
                return count($this->idata);
            }

            // Cannot be implemented with native php code
            public function extend(string $class): bool
            {
                return true;
            }

            public function isRunning(): bool
            {
                return $this->istate & THREAD::RUNNING;
            }

            public function isTerminated(): bool
            {
                return $this->istate & THREAD::ERROR;
            }

            public function merge(mixed $from, bool $overwrite = true): bool
            {
                foreach ($from as $k => $v) {
                    if ($overwrite || !isset($this->idata[$k])) {
                        $this->idata[$k] = $v;
                    }
                }
            }

            public function notify(): bool
            {
                return true;
            }

            public function notifyOne(): bool
            {
                return true;
            }

            public function pop(): bool
            {
                return array_pop($this->idata);
            }

            public function run(): void
            {
                // TODO: Implement run() method.
            }

            public function shift(): mixed
            {
                return array_shift($this->idata);
            }

            public function synchronized(Closure $block, ...$args): mixed
            {
                return $block(...$args);
            }

            public function wait(int $timeout = 1): bool
            {
                usleep($timeout);
                return true;
            }
        }
    }
}
