<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Producer
{
    /**
     * Pushes a new task payload into the queue.
     *
     * @param Message $message The task data object to be serialized into JSON.
     * @return string The unique identifier (UUID) of the created task.
     */
    public function produce(Message $message): string;
}
