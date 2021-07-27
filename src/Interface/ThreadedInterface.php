<?php
if (!extension_loaded("pthreads")) {
    interface ThreadedInterface
    {
        public function chunk(int $size, bool $preserve = false): array;

        public function count(): int;

        public function extend(string $class): bool;

        public function isRunning(): bool;

        public function isTerminated(): bool;

        public function merge(mixed $from, bool $overwrite = true): bool;

        public function notify(): bool;

        public function notifyOne(): bool;

        public function pop(): bool;

        public function run(): void;

        public function shift(): mixed;

        public function synchronized(Closure $block, mixed ...$args): mixed;

        public function wait(int $timeout): bool;
    }
}