<?php

declare(strict_types=1);

namespace Cekta\Queue;

use DateTimeImmutable;

interface Task
{
    public function getUuid(): string;

    /**
     * Returns the Fully Qualified Class Name (FQCN) of the task message/DTO.
     */
    public function getFqcn(): string;

    /**
     * Returns the Fully Qualified Class Name (FQCN) of the handler responsible for processing this task.
     */
    public function getHandler(): string;

    /**
     * Returns the decoded task payload that was previously serialized by the Producer.
     *
     * @return mixed The decoded payload data.
     */
    public function getPayload(): mixed;

    public function getStatus(): Status;

    public function getCreatedAt(): DateTimeImmutable;

    public function getStartedAt(): ?DateTimeImmutable;

    public function getFinishedAt(): ?DateTimeImmutable;
}
