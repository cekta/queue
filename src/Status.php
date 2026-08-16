<?php

declare(strict_types=1);

namespace Cekta\Queue;

enum Status: string
{
    /**
     * The task has been dispatched by the Producer and is currently waiting in the queue.
     */
    case PENDING = 'pending';

    /**
     * The task is currently being executed by the Consumer/Handler but has not yet completed.
     */
    case PROCESSING = 'processing';

    /**
     * The task completed successfully (the Handler returned true).
     */
    case SUCCESS = 'success';

    /**
     * The task failed during execution because the Handler explicitly returned false.
     */
    case FAIL = 'fail';

    /**
     * The task failed during execution because the Handler or Consumer threw an unhandled exception.
     */
    case FAIL_EXCEPTION = 'fail_exception';

    /**
     * The task was aborted because it spent too much time in the 'processing' state (stalled timeout).
     */
    case FAIL_STALE = 'fail_stale';

    case FAIL_HANDLER_NOT_FOUND = 'fail_handler_not_found';

    /**
     * The task failed due to an unexpected, catastrophic infrastructure error (e.g., sudden OOM or hard server crash).
     */
    case FAIL_UNKNOWN = 'fail_unknown';
}
