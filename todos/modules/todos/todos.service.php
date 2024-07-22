<?php

namespace Todos\Modules;


use Exception;
use Todos\Dtos\TodoDto;

class TodosService {
    private string $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'todos';
    }

    /**
     * @param TodoDto[] $todos
     */
    public function html(array $todos): string
    {
        ob_start();
        load_template(TODOS_PATH . '/template-parts/list.php', true, [ 'todos' => $todos ] );
        return ob_get_clean();
    }

    /**
     * @return TodoDto[]
     * @throws Exception
     */
    public function findAll(): array
    {
        global $wpdb;

        $result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table_name"), ARRAY_A);
        if (!$result) {
            throw new Exception("Todos not found");
        }

        return array_map(fn($todo) => TodoDto::transform($todo), $result);
    }

    /**
     * @param TodoDto[] $todos
     * @throws Exception
     */
    public function save(array $todos): string
    {
        global $wpdb;

        $db_todos = $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table_name"), ARRAY_A);

        if (!$db_todos) {
            array_map(function($todo) {
                global $wpdb;
                $wpdb->insert($this->table_name, (array)$todo);
            }, $todos);
            return __( 'Todos updated', 'ip-b' );
        }

        $db_todos = array_map(fn($todo) => TodoDto::transform($todo), $db_todos);

        /**
         * @var TodoDto[] $not_exists
         * @var TodoDto[] $mutated
         */
        $not_exists = [];
        $mutated = [];

        $db_ids = [];
        foreach ($todos as $todo) {
            foreach ($db_todos as $db_todo) {
                if (!in_array($db_todo->id, $db_ids)) {
                    $db_ids[] = $db_todo->id;
                }

                if ($todo->id === $db_todo->id && $todo->completed !== $db_todo->completed) {
                    $mutated[] = $todo;
                }
            }

            if (!in_array($todo->id, $db_ids)) {
                $not_exists[] = $todo;
            }
        }

        array_map(function($todo) {
            global $wpdb;
            $wpdb->insert($this->table_name, (array)$todo);
        }, $not_exists);

        array_map(function($todo) {
            global $wpdb;
            $wpdb->update($this->table_name, [ 'completed' => $todo->completed ], ['id' => $todo->id ]);
        }, $mutated);

        return __( 'Todos updated', 'ip-b' );
    }
}