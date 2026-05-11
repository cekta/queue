# Агенты и архитектура CEKTA/Queue

## Обзор

**CEKTA/Queue** — это PHP-библиотека, представляющая абстракцию над системами очередей сообщений (RabbitMQ, Kafka, Redis, Beanstalk, СУБД и др.).

## Архитектура

Проект построен на принципе разделения ответственности между несколькими ключевыми компонентами:

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│  Producer   │────▶│   Queue      │────▶│  Consumer   │
│  (создатель │     │  (хранилище) │     │ (обработчик)│
│   задач)    │     │              │     │             │
└─────────────┘     └─────────────┘     └─────────────┘
                                               │
                                               ▼
                                        ┌─────────────┐
                                        │  Handler    │
                                        │ (исполнитель│
                                        │  задачи)    │
                                        └─────────────┘
```

## Основные сущности

| Компонент | Описание | Зона ответственности |
|-----------|----------|---------------------|
| **Task** | Интерфейс задачи | Определяет структуру задачи, содержит `getHandler()` |
| **TaskDTO** | DTO для передачи данных | Хранит uuid, fqcn, handler, payload, status, created_at |
| **Status** | Enum статусов | PENDING, IN_PROGRESS, SUCCESS, FAIL |
| **Producer** | Отправитель задач | Постановка задач в очередь, возвращает uuid |
| **Consumer** | Получатель задач | `work()` — постоянная обработка, `once()` — однократная |
| **Handler** | Обработчик задач | Выполняет бизнес-логику по TaskDTO |
| **Inspector** | Инспектор | Получение информации о задаче по UUID |

## Жизненный цикл задачи

1. **PENDING** — задача создана и ожидает обработки
2. **IN_PROGRESS** — задача взята в обработку
3. **SUCCESS/FAIL** — задача завершена (успешно или с ошибкой)

## Пример использования

### 1. Определение задачи

```php
use Cekta\Queue\Task;

class EmailNotification implements Task
{
    public function __construct(
        public readonly string $to,
        public readonly string $subject,
        public readonly string $body
    ) {}

    public function getHandler(): string
    {
        return EmailNotificationHandler::class;
    }
}
```

### 2. Определение обработчика

```php
use Cekta\Queue\Handler;
use Cekta\Queue\TaskDTO;

class EmailNotificationHandler implements Handler
{
    public function handle(TaskDTO $taskDTO): bool
    {
        $payload = $taskDTO->payload;
        // Отправка email...
        return true;
    }
}
```

### 3. Использование Producer и Consumer

```php
// Producer — отправка задачи
$producer = new SomeQueueProducer();
$uuid = $producer->send(new EmailNotification('test@example.com', 'Hi', 'Hello!'));

// Consumer — обработка задач
$consumer = new SomeQueueConsumer($handler);
$consumer->work(); // постоянная обработка
// или
$consumer->once(); // однократная обработка
```

## Требования

- PHP >= 8.2
- Для Consumer: расширение pcntl (для режима постоянной обработки)

## Дополнительные возможности

- **Inspector** — позволяет отслеживать статус задачи по UUID
- **Идемпотентность** — обеспечивается через UUID (рекомендуется UUID v7)
- **Сериализация** — Task реализует JsonSerializable для передачи payload