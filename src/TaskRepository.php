<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface TaskRepository
{
    public function findByUuid(string $uuid): ?Task;
}
