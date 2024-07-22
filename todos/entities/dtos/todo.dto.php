<?php

namespace Todos\Dtos;

use Exception;
use Todos\Interfaces\DtoInterface;

class TodoDto implements DtoInterface {
    public int $id;
    public int $userId;
    public string $title;
    public bool $completed;

    /**
     * @throws Exception
     */
    static function transform(mixed $args): TodoDto
    {
        if (!$args['id'] || !$args['title'] || !$args['userId'] || !isset($args['completed'])) {
            throw new Exception("Missing required parameters");
        }

        $dto = new TodoDto();
        $dto->id = $args['id'];
        $dto->title = $args['title'];
        $dto->userId = $args['userId'];
        $dto->completed = $args['completed'];
        return $dto;
    }
}