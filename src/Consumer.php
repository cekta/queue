<?php

namespace Cekta\Queue;

interface Consumer
{
    public function consume(): void;
}
