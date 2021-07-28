<?php

namespace {

    use Swoole\Coroutine;

    if (!extension_loaded("pthreads")) {

        class Worker extends Thread implements IteratorAggregate, Countable, ArrayAccess, WorkerInterface
        {
            private $stack = [];
            private $gc = [];

            public function __construct(){
                parent::__construct();
            }

            public function collect(Closure $collector = null): int
            {
                foreach (
                    $this->gc as $idx => $collectable) {
                    if ($collector) {
                        if ($collector($collectable)) {
                            unset($this->gc[$idx]);
                        }
                    } else {
                        if ($this->collector($collectable)) {
                            unset($this->gc[$idx]);
                        }
                    }
                }

                return count($this->gc) + count($this->stack);
            }

            public function stack(Threaded $threaded): int
            {
                $this->stack[] = $threaded;
                if ($this->isStarted()) {
                    $this->runCollectable(count($this->stack) - 1, $threaded);
                }
                return count($this->stack);
            }

            public function run(): void
            {
                foreach ($this->stack as $idx => $collectable) {
                    $this->runCollectable($idx, $collectable);
                }
            }

            private function runCollectable($idx, Threaded $threaded)
            {
                $threaded->worker = $this;
                $threaded->__setState(THREAD::RUNNING);
                $threaded->run();
                $threaded->__setState(-THREAD::RUNNING);
                $this->gc[] = $threaded;
                unset($this->stack[$idx]);
            }

            public function collector(Threaded $threaded)
            {
                return $threaded->isGarbage();
            }

            public function shutdown(): bool
            {
                return $this->join();
            }

            public function isShutdown(): bool
            {
                return $this->isJoined();
            }

            public function getStacked(): int
            {
                return count($this->stack);
            }

            public function unstack(): int
            {
                array_shift($this->stack);
                return count($this->stack);
            }

        }
    }

}
