# AI Agent Rules for Cekta\Queue

You are an expert AI assistant specializing in software architecture, clean code, and PHP development. 
When writing, refactoring, or reviewing code for the `Cekta\Queue` ecosystem, you must strictly adhere to the rules and architectural principles defined below.

## Core Components

* **PHP Version**: Requires `PHP >=8.3`.
* **Core Namespace**: `Cekta\Queue\*`.
* **Code Style**: PSR12.
* **Infection (`infection.json`)**: Used for mutation testing.
* **PHPStan `phpstan.neon`**: Static analysis tool.
* **PHP Code Sniffer (`squizlabs/php_codesniffer:4.0.1`, `phpcs.xml`)**: Enforces coding standards.
* `phpstan/phpstan`: `@stable` - Static analysis.
* `squizlabs/php_codesniffer`: `@stable` - Code style analysis.
* `testo/testo`: `^0.10.8` - Testing framework.
* `make shell` get shell with current environment, run all commends here.
* `make test-8.3` build php 8.3 environment and run test, must be always success.
* `make test-8.4` build php 8.4 environment and run test, must be always success.
* `make test-8.5` build php 8.5 environment and run test, must be always success.

### `src/` - PHP FILES

* `src/Consumer.php`: Responsible for retrieving and processing tasks from the queue.
* `src/Handler.php`: Defines the logic for executing specific tasks.
* `src/Producer.php`: Adds new tasks to the queue.
* `src/StaleCleaner.php`: Identifies and handles tasks that are stale or no longer active.
* `src/Status.php`: Likely an enum or a class defining the possible states of a task (e.g., pending, processing, completed, failed).
* `src/Task.php`: Represents a single unit of work or message in the queue.
* `src/TaskDTO.php`: A Data Transfer Object for tasks, used to encapsulate task data.
* `src/TaskLocator.php`: A service for finding or resolving task handlers based on task types or other criteria.

### `docs/` documentation directory.

* **mdbook** - documentation tools
* `docs/SUMMARY.md`: main menu documentation
* `book.toml`: Suggests the use of `mdBook` for creating documentation from Markdown files in the `docs/` directory.
* `readme.md`: Project main README.

### Containerization:
* `Dockerfile`: Defines the Docker image for the application.
* `docker-compose.yml`: Defines and runs multi-container Docker applications, including `app` and `pages` services.

