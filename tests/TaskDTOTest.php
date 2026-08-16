<?php

declare(strict_types=1);

namespace Cekta\Queue\Test;

use Cekta\Queue\Status;
use Cekta\Queue\TaskDTO;
use DateTimeImmutable;
use Testo\Assert;
use Testo\Test;

final class TaskDTOTest
{
    #[Test]
    public function shouldCreateTaskDTO(): void
    {
        $uuid = 'test-uuid-123';
        $fqcn = 'SomeClass';
        $payload = ['key' => 'value'];
        $status = Status::PENDING;
        $createdAt = new DateTimeImmutable('2024-01-01');
        $startedAt = new DateTimeImmutable('2024-01-02');
        $finishedAt = new DateTimeImmutable('2024-01-03');

        $dto = new TaskDTO(
            $uuid,
            $fqcn,
            $payload,
            $status,
            $createdAt,
            $startedAt,
            $finishedAt
        );

        Assert::same($dto->getUuid(), $uuid);
        Assert::same($dto->getFqcn(), $fqcn);
        Assert::same($dto->getPayload(), $payload);
        Assert::same($dto->getStatus(), $status);
        Assert::same($dto->getCreatedAt(), $createdAt);
        Assert::same($dto->getStartedAt(), $startedAt);
        Assert::same($dto->getFinishedAt(), $finishedAt);
    }

    #[Test]
    public function shouldBeReadonly(): void
    {
        $reflection = new \ReflectionClass(TaskDTO::class);
        Assert::true($reflection->isReadOnly());
    }
}
