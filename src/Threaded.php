<?php
if (!extension_loaded("pthreads")) {
    /** TO BE IMPLEMENTED:
     * Collectable - DONE
	 * IteratorAggregate
	 * Countable
     * ArrayAccess
     * ThreadedInterface
	 */
	class Threaded implements Collectable, IteratorAggregate, Countable, ArrayAccess, ThreadedInterface {

	    protected bool $_GARBAGE;

        public function isGarbage():bool
        {
            // TODO: Implement isGarbage() method.
        }

        public function setGarbage()
        {
            // TODO: Implement setGarbage() method.
        }

        public function getIterator()
        {
            // TODO: Implement getIterator() method.
        }

        public function offsetExists($offset)
        {
            // TODO: Implement offsetExists() method.
        }

        public function offsetGet($offset)
        {
            // TODO: Implement offsetGet() method.
        }

        public function offsetSet($offset, $value)
        {
            // TODO: Implement offsetSet() method.
        }

        public function offsetUnset($offset)
        {
            // TODO: Implement offsetUnset() method.
        }

        public function chunk ( int $size , bool $preserve ) : array{
            // TODO: Implement chunk() method.
        }

        public function count() : int
        {
            // TODO: Implement count() method.
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

        public function merge(mixed $from, bool $overwrite): bool
        {
            // TODO: Implement merge() method.
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
