<?php

namespace Todos\Modules;

use Todos\Instances\WithLogger;
use Todos\Interfaces\ModuleInterface;

class ShortcodesModule extends WithLogger implements ModuleInterface {
    public function init(): void
    {
        $shortcodes = new ShortcodeService();
        $shortcodes->setLogger($this->logger);

        add_shortcode('todos', [$shortcodes, 'todos']);
    }
}