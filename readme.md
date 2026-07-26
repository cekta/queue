# Cekta Queue

A minimalist, type-safe, and atomic state-machine queue component for modern PHP applications.

## Key Features

- **Atomic Consumption:** Pull-based consumer architecture that handles exactly one task per invocation, eliminating forced infinite loops inside the library.
- **Strictly Typed DTOs:** Producers accept `JsonSerializable` objects, guaranteeing predictable and structured payload serialization.
- **Stalled Worker Protection:** Built-in tools to detect and recover from crashed or timed-out workers.
- **No Invisible Retries:** Handlers own their business context and can explicitly dispatch new messages if a retry policy is needed, avoiding accidental side effects.

## Architecture Architecture Overview

The library separates concerns into six core contracts:
1. `Status` — Predictable state machine for task lifecycles.
2. `Task` — Read-only representation of the queued job metadata and decoded payload.
3. `Producer` — Dispatches strongly-typed objects into the queue storage.
4. `Handler` — Encapsulates isolated business logic.
5. `Consumer` — An atomic worker that fetches and executes a single task.
6. `StaleCleaner` — A maintenance service to release timed-out processes.