<?php

use Swoole\Coroutine\Scheduler;
use function Swoole\Coroutine\run;

if (!extension_loaded("pthreads")) {

    class Thread extends Threaded implements Countable, IteratorAggregate, ArrayAccess, ThreadInterface
    {
        public static Thread $thread;
        public Scheduler $scheduler;
        public int $state;

        public function __construct($scheduler)
        {
            self::$thread = $this;
            $this->scheduler = $scheduler;
            $this->state = 0;
        }

        public function detach(): void
        {
            // TODO: Implement detach() method.
        }

        /**
         * Pthreads: 返回创建当前线程的线程ID。
         * Swoole: 获取当前协程的父 ID。
         * @return int
         */
        public function getCreatorId(): int
        {
            return Swoole\Coroutine::getPcid([self::getCurrentThreadId()]);
        }

        public static function getCurrentThread(): Thread
        {
            return self::$thread;
        }

        public static function getCurrentThreadId(): int
        {
            return Swoole\Coroutine::getuid();
        }

        public function getThreadId(): int
        {
            return Swoole\Coroutine::getuid();
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
            return !($this->state === 0);
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
            return true;
        }
        public function run() :void
        {
            $that = $this;
            $this->scheduler->add(function ($that){
                $that->start();
            },$that);
            unset($that);
        }
    }
}
