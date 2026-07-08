<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface TaskLocator
{
    public function findByUuid(string $uuid): ?Task;
}
