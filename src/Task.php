<?php

declare(strict_types=1);

namespace Cekta\Queue;

use DateTimeImmutable;

interface Task
{
    public function getUuid(): string;
    public function getFqcn(): string;
    public function getHandler(): string;

    /**
     * @return mixed decoded payload
     */
    public function getPayload(): mixed;
    public function getStatus(): Status;
    public function getCreatedAt(): DateTimeImmutable;
    public function getStartedAt(): ?DateTimeImmutable;
    public function getFinishedAt(): ?DateTimeImmutable;
}
