<?php

namespace Todos\Modules;

use Todos\Dtos\TodoDto;
use Todos\Instances\WithLogger;

class TodosController extends WithLogger {
    private ?TodosService $todosService;

    public function __construct(TodosService $todosService = null)
    {
        $this->todosService = $todosService;

        add_action( 'wp_ajax_html_todos', [$this, 'html'] );
        add_action( 'wp_ajax_nopriv_html_todos', [$this, 'html'] );

        add_action( 'wp_ajax_receive_todos', [$this, 'receiveAll'] );
        add_action( 'wp_ajax_nopriv_receive_todos', [$this, 'receiveAll'] );

        add_action( 'wp_ajax_send_todos', [$this, 'save'] );
        add_action( 'wp_ajax_nopriv_send_todos', [$this, 'save'] );
    }

    public function html(): void
    {
        if (!$_REQUEST['todos']) {
            $error = __( 'Todos is empty', 'ip-b' );
            $this->logger?->error( $error, [ 'status' => 400 ] );
        }

        try {
            $parsed_todos = json_decode(str_replace('\"', '"', $_REQUEST['todos']), true);
            $todos = array_map(fn($todo) => TodoDto::transform($todo), $parsed_todos);
            wp_send_json_success($this->todosService?->html($todos), 200);
        } catch (\Exception $e) {
            $this->logger?->error( $e->getMessage(), [ 'status' => 400 ] );
        }
    }

    public function receiveAll(): void
    {
        try {
            $todos = $this->todosService?->findAll();
            wp_send_json_success($todos, 200);
        } catch ( \Exception $e ) {
            $this->logger?->error( $e->getMessage(), [ 'status' => 404 ] );
        }
    }

    public function save(): void
    {
        if (!$_REQUEST['todos']) {
            $error = __( 'Todos is empty', 'ip-b' );
            $this->logger?->error( $error, [ 'status' => 400 ] );
        }

        try {
            $parsed_todos = json_decode(str_replace('\"', '"', $_REQUEST['todos']), true);
            $todos = array_map(fn($todo) => TodoDto::transform($todo), $parsed_todos);
            wp_send_json_success($this->todosService?->save($todos), 200);
        } catch (\Exception $e) {
            $this->logger?->error( $e->getMessage(), [ 'status' => 400 ] );
        }
    }
}