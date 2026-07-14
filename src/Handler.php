<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Handler
{
    /**
     * payload class for handle
     * @return class-string
     */
    public function forType(): string;
    public function handle(Task $task): bool;
}
