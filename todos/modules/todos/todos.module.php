<?php

namespace Todos\Modules;

use Todos\Instances\WithLogger;
use Todos\Interfaces\ModuleInterface;

class TodosModule extends WithLogger implements ModuleInterface {
    public function init(): void
    {
        $todos = new TodosController(new TodosService());
        $todos->setLogger(new AjaxLogger());
    }
}