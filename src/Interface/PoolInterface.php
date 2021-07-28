<?php
/**
 * PoolInterface.php
 *
 * @project pthwools
 * @author lixworth <lixworth@outlook.com>
 * @copyright pthwools
 * @create 2021/7/28 23:01
 */

declare(strict_types=1);

namespace {
    if (!extension_loaded("pthreads")) {

        interface PoolInterface
        {
            /* Properties */

            /* Methods */
            public function __construct(int $size, string $class = null, array $ctor = null);
            public function collect(Callable $collector = null): int;
            public function resize(int $size): void;
            public function shutdown(): void;
            public function submit(Threaded $task): int;
            public function submitTo(int $worker, Threaded $task): int;

        }
    }
}
