<?php

namespace Todos\Instances;

use Psr\Log\LoggerInterface;
use Todos\Interfaces\WithLoggerInterface;

class WithLogger implements WithLoggerInterface {
    public ?LoggerInterface $logger;

    public function setLogger(LoggerInterface $logger = null): void
    {
        $this->logger = $logger;
    }
}