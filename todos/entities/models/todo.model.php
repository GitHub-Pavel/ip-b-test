<?php

namespace Todos\Models;

use Todos\Instances\Model;
use Todos\Interfaces\ModelInterface;
use Psr\Log\LoggerInterface;

class Todo extends Model implements ModelInterface {
    public function __construct()
    {
        parent::__construct('todos');
    }

    public function migrate(): void
    {
        dbDelta( "CREATE TABLE $this->table_name (
            id mediumint(9) NOT NULL UNIQUE KEY,
            userId mediumint(9) NOT NULL DEFAULT 0,
            completed boolean DEFAULT false,
            title tinytext NOT NULL,
            PRIMARY KEY  (id)
        ) $this->charset;" );
    }
}