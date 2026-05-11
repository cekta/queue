<?php

namespace Cekta\Queue;

use DateTimeImmutable;

readonly class TaskDTO
{
    public function __construct(
        public string $uuid,
        public string $fqcn,
        public string $handler,
        public mixed $payload,
        public Status $current_status,
        public DateTimeImmutable $created_at,
    ) {}
}
