<?php

namespace Todos\Interfaces;

use Psr\Log\LoggerInterface;

/**
 * @property ?LoggerInterface $logger
 */
interface WithLoggerInterface
{
    public function setLogger(LoggerInterface $logger = null): void;
}