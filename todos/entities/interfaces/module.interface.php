<?php

namespace Todos\Interfaces;

interface ModuleInterface extends WithLoggerInterface
{
    public function init(): void;
}