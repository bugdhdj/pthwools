<?php

namespace {

    if (!extension_loaded("pthreads")) {
        require_once('Interface/ThreadedInterface.php');
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

            protected array $data;
            protected int $state;

            public function __construct()
            {
                $this->state=THREAD::NOTHING;
            }

            public function __setState($state): bool
            {
                $this->state += $state;
                return true;
            }

            public function __set($offset, $value)
            {
                if ($offset === null) {
                    $offset = count($this->data);
                }

                if (!$this instanceof Volatile) {
                    if (isset($this->data[$offset]) &&
                        $this->data[$offset] instanceof Threaded) {
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

                return $this->data[$offset] = $value;
            }

            public function __get($offset)
            {
                return $this->data[$offset];
            }

            public function __isset($offset)
            {
                return isset($this->data[$offset]);
            }

            public function __unset($offset)
            {
                if (!$this instanceof Volatile) {
                    if (isset($this->data[$offset]) && $this->data[$offset] instanceof Threaded) {
                        throw new \RuntimeException();
                    }
                }
                unset($this->data[$offset]);
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
                return new ArrayIterator($this->data);
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
                return count($this->data);
            }

            // Cannot be implemented with native php code
            public function extend(string $class): bool
            {
                return true;
            }

            public function isRunning(): bool
            {
                return $this->state & THREAD::RUNNING;
            }

            public function isTerminated(): bool
            {
                return $this->state & THREAD::ERROR;
            }

            public function merge(mixed $from, bool $overwrite = true): bool
            {
                foreach ($from as $k => $v) {
                    if ($overwrite || !isset($this->data[$k])) {
                        $this->data[$k] = $v;
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
                return array_pop($this->data);
            }

            public function run(): void
            {
                // TODO: Implement run() method.
            }

            public function shift(): mixed
            {
                return array_shift($this->data);
            }

            public function synchronized(Closure $block, ...$args): mixed
            {
                return $block(...$args);
            }

            public function wait(int $timeout): bool
            {
                return true;
            }
        }
    }
}
