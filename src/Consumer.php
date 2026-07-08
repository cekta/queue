<?php

declare(strict_types=1);

namespace Cekta\Queue;

interface Consumer
{
    public function findNext(): ?Task;
}
