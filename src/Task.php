<?php

declare(strict_types=1);

namespace Cekta\Queue;

use JsonSerializable;

interface Task extends JsonSerializable
{
    public function getHandler(): string;
}
