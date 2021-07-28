<?php
/**
 * ThreadInterface.php
 *
 * @project pthwools
 * @author lixworth <lixworth@outlook.com>
 * @copyright pthwools
 * @create 2021/7/28 0:21
 */
namespace {

    if (!extension_loaded("pthreads")) {

        interface ThreadInterface
        {
            public function getCreatorId(): int;

            public static function getCurrentThread(): Thread;

            public static function getCurrentThreadId(): int;

            public function getThreadId(): int;

            public function isJoined(): bool;

            public function isStarted(): bool;

            public function join(): bool;

            public function start(int $options = PTHREADS_INHERIT_ALL): bool;
        }

    }
}