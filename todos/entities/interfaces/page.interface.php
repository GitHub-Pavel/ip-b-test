<?php

namespace Todos\Interfaces;

/**
 * @property string $name
 * @property string $capability
 * @property string $slug
 * @property string $icon
 * @property int $position
 */
interface PageInterface extends WithLoggerInterface {
    public function render(): void;
}