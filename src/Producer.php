<?php

declare(strict_types=1);

namespace Cekta\Queue;

use JsonSerializable;

interface Producer
{
    /**
     * @param JsonSerializable $payload opbject, jsonSerialize() transform to task payload
     * @return string uuid
     */
    public function send(JsonSerializable $payload): string;
}
