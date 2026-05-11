<?php

namespace Cekta\Queue;

interface Inspector
{
    public function inspect(string $uuid): TaskDTO;
}
