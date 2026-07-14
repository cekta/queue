<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Consumer
{
    public function stop(): void;
    public function run(): int;
    public function runOnce(): void;
}
