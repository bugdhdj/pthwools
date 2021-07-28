<?php

namespace {

    use Swoole\Coroutine;

    if (!extension_loaded("pthreads")) {

        class Thread extends Threaded implements Countable, IteratorAggregate, ArrayAccess, ThreadInterface
        {

            public function getCreatorId(): int
            {
                // TODO: Implement getCreatorId() method.
            }

            public static function getCurrentThread(): Thread
            {
                // TODO: Implement getCurrentThread() method.
            }

            public static function getCurrentThreadId(): int
            {
                // TODO: Implement getCurrentThreadId() method.
            }

            public function getThreadId(): int
            {
                // TODO: Implement getThreadId() method.
            }

            public static function globally(): mixed
            {
                // TODO: Implement globally() method.
            }

            public function isJoined(): bool
            {
                // TODO: Implement isJoined() method.
            }

            public function isStarted(): bool
            {
                // TODO: Implement isStarted() method.
            }

            public function join(): bool
            {
                // TODO: Implement join() method.
            }

            public function kill(): void
            {
                // TODO: Implement kill() method.
            }

            public function start(int $options = PTHREADS_INHERIT_ALL): bool
            {
                // TODO: Implement start() method.
            }
        }
    }

}