<?php

namespace Todos\Modules;

use Psr\Log\LoggerInterface;

class LoggerService implements LoggerInterface {
    public function info(\Stringable|string $message, array $context = []): void
    {
        echo $message;
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        echo $message;
    }

    public function emergency(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement emergency() method.
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement alert() method.
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement critical() method.
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement warning() method.
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement notice() method.
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        // TODO: Implement debug() method.
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        // TODO: Implement log() method.
    }
}