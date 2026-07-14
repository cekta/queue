<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Handler
{
    /**
     * payload class for handle
     * @return class-string
     */
    public static function getHandledType(): string;
    public function handle(Task $task): bool;
}
