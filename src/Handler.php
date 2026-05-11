<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Handler
{
    /**
     * @return bool true on success handle
     */
    public function handle(TaskDTO $taskDTO): bool;
}
