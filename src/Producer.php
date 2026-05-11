<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Producer
{
    /**
     * @param Task $task
     * @return string uuid or bigint, ordered number
     */
    public function send(Task $task): string;
}
