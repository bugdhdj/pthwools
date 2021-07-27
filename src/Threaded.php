<?php
if (!extension_loaded("pthreads")) {
    /** TO BE IMPLEMENTED:
     * Collectable - DONE
	 * IteratorAggregate - DONE
	 * Countable - DONE
     * ArrayAccess - DONE
     * ThreadedInterface
	 */
	class Threaded implements Collectable, IteratorAggregate, Countable, ArrayAccess, ThreadedInterface {

        const NOTHING = (0);
        const STARTED = (1<<0);
        const RUNNING = (1<<1);
        const JOINED  = (1<<2);
        const ERROR   = (1<<3);

        protected array $data;
        protected int $state;

        public function __set($offset, $value){
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

        public function __get($offset){
            return $this->data[$offset];
        }

        public function __isset($offset) {
            return isset($this->data[$offset]);
        }

        public function __unset($offset)		 {
            if (!$this instanceof Volatile) {
                if (isset($this->data[$offset]) && $this->data[$offset] instanceof Threaded) {
                    throw new \RuntimeException();
                }
            }
            unset($this->data[$offset]);
        }

        private function convertToVolatile($value) {
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


        public function isGarbage():bool
        {
            return true;
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

        public function chunk ( int $size , bool $preserve = false ) : array{
            // TODO: Implement chunk() method.
        }

        public function count() : int
        {
            return count($this->data);
        }

        public function extend(string $class): bool
        {
            // TODO: Implement extend() method.
        }

        public function from(Closure $run, Closure $construct, array $args): Threaded
        {
            // TODO: Implement from() method.
        }

        public function getTerminationInfo(): array
        {
            // TODO: Implement getTerminationInfo() method.
        }

        public function isRunning(): bool
        {
            // TODO: Implement isRunning() method.
        }

        public function isTerminated(): bool
        {
            // TODO: Implement isTerminated() method.
        }

        public function isWaiting(): bool
        {
            // TODO: Implement isWaiting() method.
        }

        public function lock(): bool
        {
            // TODO: Implement lock() method.
        }

        public function merge(mixed $from, bool $overwrite = true): bool
        {
            foreach ($from as $k => $v) {
                if($overwrite || !isset($this->data[$k])){
                    $this->data[$k] = $v;
                }
            }
        }

        public function notify(): bool
        {
            // TODO: Implement notify() method.
        }

        public function notifyOne(): bool
        {
            // TODO: Implement notifyOne() method.
        }

        public function pop(): bool
        {
            // TODO: Implement pop() method.
        }

        public function run(): void
        {
            // TODO: Implement run() method.
        }

        public function shift(): mixed
        {
            // TODO: Implement shift() method.
        }

        public function synchronized(Closure $block, ...$args): mixed
        {
            // TODO: Implement synchronized() method.
        }

        public function unlock(): bool
        {
            // TODO: Implement unlock() method.
        }

        public function wait(int $timeout): bool
        {
            // TODO: Implement wait() method.
        }
    }
}
