<?php
/**
 * WorkerInterface.php
 *
 * @project pthwools
 * @author lixworth <lixworth@outlook.com>
 * @copyright pthwools
 * @create 2021/7/28 20:59
 */

declare(strict_types=1);

namespace {

    if (!extension_loaded("pthreads")) {

        interface WorkerInterface
        {
            public function collect(Closure $collector = null): int;

            public function getStacked(): int;

            public function isShutdown(): bool;

            public function shutdown(): bool;

            public function stack(Threaded $work): int;

            public function unstack(): int;

        }
    }
}
