# Агенты и архитектура CEKTA/Queue

## Обзор

**CEKTA/Queue** — это PHP-библиотека, предоставляющая интерфейсы (абстракцию) над системами очередей сообщений (RabbitMQ, Kafka, Redis, Beanstalk, СУБД и др.).

Библиотека определяет базовые интерфейсы (контракты), а реализации под конкретные брокеры (RabbitMQ, Kafka, Redis, БД и др.) предоставляются пользователем.

## Архитектура

Проект построен на принципе разделения ответственности между несколькими ключевыми компонентами:

```
┌───────────────────┐
│     Producer      │     Producer принимает произвольный JsonSerializable-объект
│   (отправитель)   │────▶ и ставит его в очередь. Возвращает UUID задачи.
└────────┬──────────┘
         │  send(JsonSerializable $payload): string
         ▼
┌──────────────────────────────────┐
│  Внешняя очередь / Брокер        │     Конкретная реализация (RabbitMQ, Kafka,
│  (не входит в библиотеку)        │     Redis, БД и т.д.) — предоставляется
│                                  │     пользователем библиотеки.
└──────────────────────────────────┘
         │
         ▼
┌───────────────────┐
│     Handler       │     Handler получает Task (с payload из исходного объекта)
│   (исполнитель    │     и выполняет бизнес-логику.
│    задачи)        │     Метод handle(Task $task): bool.
└───────────────────┘

┌───────────────────┐
│  TaskRepository   │     Позволяет найти задачу по UUID.
│  (репозиторий)    │     Метод findByUuid(string $uuid): ?Task.
└───────────────────┘
```

## Основные сущности

| Компонент | Описание | Зона ответственности |
|-----------|----------|---------------------|
| **Task** | Интерфейс задачи | Определяет структуру задачи, содержит uuid, fqcn, handler, payload, status, даты |
| **TaskDTO** | DTO-реализация Task (final readonly) | Хранит и отдаёт все поля задачи |
| **Status** | Enum статусов | PENDING, PROCESSING, SUCCESS, FAIL |
| **Producer** | Отправитель задач | Принимает `JsonSerializable $payload`, возвращает `string` (uuid). Его `jsonSerialize()` станет payload задачи |
| **Handler** | Обработчик задач | Выполняет бизнес-логику. Метод `handle(Task $task): bool` |
| **TaskRepository** | Репозиторий | Поиск задачи по UUID: `findByUuid(string $uuid): ?Task` |

## Жизненный цикл задачи

1. **PENDING** — задача создана и ожидает обработки
2. **PROCESSING** — задача взята в обработку
3. **SUCCESS/FAIL** — задача завершена (успешно или с ошибкой)

## Пример использования

### 1. Определение бизнес-задачи (domain object)

Пользователь определяет произвольный класс, реализующий `JsonSerializable`. Этот класс описывает данные, которые будут поставлены в очередь.

```php
use JsonSerializable;

final readonly class EmailNotification implements JsonSerializable
{
    public function __construct(
        private string $to,
        private string $subject,
        private string $body,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'to' => $this->to,
            'subject' => $this->subject,
            'body' => $this->body,
            'type' => 'email',
        ];
    }
}
```

### 2. Реализация обработчика (Handler)

Обработчик получает `Task`, внутри которого `payload` — это данные, которые вернул `jsonSerialize()` из первоначального объекта.

```php
use Cekta\Queue\Handler;
use Cekta\Queue\Task;

class EmailNotificationHandler implements Handler
{
    public function handle(Task $task): bool
    {
        /** @var array{to: string, subject: string, body: string} $payload */
        $payload = $task->getPayload();
        
        // Отправка email...
        // $payload['to'], $payload['subject'], $payload['body']
        
        return true;
    }
}
```

### 3. Использование Producer

Producer принимает `JsonSerializable $payload` и возвращает UUID поставленной задачи.

```php
$producer = new SomeRabbitMQProducer(); // конкретная реализация Producer
$uuid = $producer->send(new EmailNotification(
    to: 'user@example.com',
    subject: 'Hi',
    body: 'Hello!',
));

echo $uuid; // UUID задачи, под которым она хранится в очереди
```

> **Как это работает**: `send()` получает `$payload` — произвольный `JsonSerializable`. Его `jsonSerialize()` будет сохранён в очереди. Когда обработчик (`Handler`) получит задачу, эти данные станут доступны через `Task::getPayload()`.

## Требования

- PHP >= 8.2
- **Перед отправкой PR обязателен запуск `make test`** — запускает все проверки (phpcs, phpstan, testo) в Docker

## Дополнительные возможности

- **TaskRepository** — позволяет найти задачу по UUID
- **Идемпотентность** — обеспечивается через UUID (рекомендуется UUID v7)
- **Payload** — произвольные данные, передаваемые в Handler
