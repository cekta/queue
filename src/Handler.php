<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Handler
{
    /**
     * Processes the given task and returns the execution status.
     *
     * @param Task $task The task instance to be processed.
     * @return bool True if the task completed successfully (acknowledgment),
     *              false if it failed.
     */
    public function handle(Task $task): bool;
}
