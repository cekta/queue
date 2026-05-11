<?php

namespace Cekta\Queue;

interface Consumer
{
    public function work(): void;
    public function once(): void;
}
