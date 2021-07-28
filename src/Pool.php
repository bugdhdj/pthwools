<?php

namespace {
    if (!extension_loaded("pthreads")) {

        class Pool implements PoolInterface
        {
            protected int $size;
            protected $class;
            protected array $workers;
            protected $ctor;
            protected int $last;

            public function __construct(int $size, string $class = null, array $ctor = null)
            {
                $this->size = $size;
                $this->class = $class;
                $this->ctor = $ctor;
            }

            public function collect(callable $collector = null): int
            {
                $total = 0;
                foreach ($this->workers as $worker) {
                    $total += $worker->collect($collector);
                }
                return $total;
            }

            public function resize(int $size): void
            {
                if ($size < $this->size) {
                    while ($this->size > $size) {
                        if (isset($this->workers[$this->size - 1]))
                            $this->workers[$this->size - 1]->shutdown();
                        unset($this->workers[$this->size - 1]);
                        $this->size--;
                    }
                }
            }

            public function shutdown(): void
            {
                unset($this->workers);
            }

            public function submit(Threaded $threaded): int
            {
                if ($this->last > $this->size) {
                    $this->last = 0;
                }

                if (!isset($this->workers[$this->last])) {
                    $this->workers[$this->last] = new $this->class(...$this->ctor);
                    $this->workers[$this->last]->start();
                }

                return count($this->workers[$this->last++]->stack($threaded));
            }

            public function submitTo(int $worker, Threaded $threaded): int
            {
                if (isset($this->workers[$worker])) {
                    return count($this->workers[$worker]->stack($threaded));
                }
            }
        }
    }
}

