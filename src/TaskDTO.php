<?php

declare(strict_types=1);

namespace Cekta\Queue;

use DateTimeImmutable;

final readonly class TaskDTO implements Task
{
    public function __construct(
        private string $uuid,
        private string $fqcn,
        private string $handler,
        private mixed $payload,
        private Status $status,
        private DateTimeImmutable $createdAt,
        private ?DateTimeImmutable $startedAt,
        private ?DateTimeImmutable $finishedAt,
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getFqcn(): string
    {
        return $this->fqcn;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }

    public function getPayload(): mixed
    {
        return $this->payload;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getStartedAt(): ?DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function getFinishedAt(): ?DateTimeImmutable
    {
        return $this->finishedAt;
    }
}
