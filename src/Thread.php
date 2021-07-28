<?php

namespace {

    use Swoole\Coroutine;

    if (!extension_loaded("pthreads")) {

        class Thread extends Threaded implements Countable, IteratorAggregate, ArrayAccess, ThreadInterface
        {

            protected static Thread $current_thread;
            protected static int $current_cid;

            protected int $cid;
            protected int $pcid;

            public function __construct()
            {
                self::$current_thread = $this;
                $thread = $this;
                $this->cid = Coroutine::create(function () use ($thread) {
                    $thread->setCid(Coroutine::getCid());
                    $thread->setPcid(Coroutine::getPcid());

                    $thread->__setState(THREAD::STARTED);

                    Coroutine::yield();

                    $thread->__setState(THREAD::RUNNING);
                    $thread->run();
                    $thread->__setState(THREAD::JOINED);
                });
                unset($thread);
            }

            public function __destruct()
            {
                $thread = $this;

                Coroutine::defer(function () use ($thread){
                    $thread->__setState(THREAD::NOTHING);
                });
                unset($thread);
            }

            public function setPcid($pcid): bool
            {
                $this->pcid = $pcid;
                return true;
            }

            public function setCid($cid): bool
            {
                $this->cid = $cid;
                self::$current_cid = $cid;
                return true;
            }

            public function getCreatorId(): int
            {
                return $this->pcid;
            }

            public static function getCurrentThread(): Thread
            {
                return self::$current_thread;
            }

            public static function getCurrentThreadId(): int
            {
                return self::$current_cid;
            }

            public function getThreadId(): int
            {
                return $this->cid;
            }

            public function isJoined(): bool
            {
                return $this->state & THREAD::JOINED;
            }

            public function isStarted(): bool
            {
                return $this->state & THREAD::STARTED;
            }

            public function join(): bool
            {
                while (Coroutine::exists($this->cid)) {
                    usleep(1000 * 100);
                }
                return true;
            }

            public function start(int $options = PTHREADS_INHERIT_ALL): bool
            {
                Coroutine::resume($this->cid);
            }
        }
    }

}