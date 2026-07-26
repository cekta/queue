<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Consumer
{
    /**
     * Fetches and processes a single task from the queue.
     *
     * This method performs a single, atomic consumption cycle: it pulls the next
     * available task, routes it to the appropriate Handler, updates its status,
     * and immediately returns. The infinite loop or scheduling mechanism must be
     * implemented externally.
     *
     * @return string|null The unique identifier (UUID) of the processed task,
     *                     or null if the queue was empty.
     */
    public function consume(): ?string;
}
