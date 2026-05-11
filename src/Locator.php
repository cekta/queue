<?php

namespace Cekta\Queue;

interface Locator
{
    public function getProducer(string $queue): Producer;
    public function getConsumer(string $queue): Consumer;
    public function getTaskDTO(string $uuid): TaskDTO;
}
