<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Message extends \JsonSerializable
{
    public static function getHandler(): string;
}
