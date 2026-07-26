<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface TaskLocator
{
    /**
     * Retrieves a task by its unique identifier from the execution history.
     *
     * This tool is primarily used for auditing, monitoring, or displaying
     * task execution results in dashboards and API endpoints.
     *
     * @param string $uuid The unique identifier of the task to find.
     * @return Task|null The task instance if found, or null if no such task exists.
     */
    public function findByUuid(string $uuid): ?Task;
}
