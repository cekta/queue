<?php

declare(strict_types=1);

namespace Cekta\Queue\Test;

use Cekta\Queue\Status;
use Cekta\Queue\TaskDTO;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TaskDTOTest extends TestCase
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

        $this->assertSame($uuid, $dto->uuid);
        $this->assertSame($fqcn, $dto->fqcn);
        $this->assertSame($handler, $dto->handler);
        $this->assertSame($payload, $dto->payload);
        $this->assertSame($status, $dto->current_status);
        $this->assertSame($createdAt, $dto->created_at);
    }

    #[Test]
    public function shouldBeReadonly(): void
    {
        $reflection = new \ReflectionClass(TaskDTO::class);
        $this->assertTrue($reflection->isReadOnly());
    }
}