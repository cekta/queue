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
        $handler = 'SomeHandler';
        $payload = ['key' => 'value'];
        $status = Status::PENDING;
        $createdAt = new DateTimeImmutable('2024-01-01');

        $dto = new TaskDTO($uuid, $fqcn, $handler, $payload, $status, $createdAt);

        Assert::same($dto->uuid, $uuid);
        Assert::same($dto->fqcn, $fqcn);
        Assert::same($dto->handler, $handler);
        Assert::same($dto->payload, $payload);
        Assert::same($dto->current_status, $status);
        Assert::same($dto->created_at, $createdAt);
    }

    #[Test]
    public function shouldBeReadonly(): void
    {
        $reflection = new \ReflectionClass(TaskDTO::class);
        Assert::true($reflection->isReadOnly());
    }
}
