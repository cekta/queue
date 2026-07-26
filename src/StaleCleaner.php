<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface StaleCleaner
{
    /**
     * Identifies stuck or stalled jobs in processing state,
     * marks them as failed, and returns their identifiers.
     *
     * @return string[] Array of UUIDs of the jobs that were marked as failed.
     */
    public function clean(): array;
}
