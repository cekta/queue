<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Handler
{
    public function handle(Task $task): bool;
}
