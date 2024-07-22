<?php

namespace Todos\Pages;

use Todos\Instances\WithLogger;
use Todos\Interfaces\PageInterface;
use Todos\Modules\TodosService;

class AdminPage extends WithLogger implements PageInterface {
    public string $name;
    public string $capability;
    public string $slug;
    public string $icon;
    public int $position;

    public function __construct()
    {
        $this->slug = 'todos';
        $this->position = 4;
        $this->capability = 'edit_pages';
        $this->icon = 'dashicons-editor-ul';
        $this->name = esc_html__('Todos', 'ip-b');
    }

    public function render(): void
    {
        load_template(TODOS_PATH . '/template-parts/header.php' );

        ?>
        <input type="text" id="todos-search" placeholder="Search..." />
        <div class="todos-wrap">
        <div id="todos-list">
        <?php

        try {
            $todosService = new TodosService();
            $todos = $todosService->findAll();
            load_template(TODOS_PATH . '/template-parts/list.php', true, [ 'todos' => $todos ] );
        } catch ( \Exception $e ) {
            $this->logger?->error( $e->getMessage() );
        }

        ?> </div> <?php
        load_template(TODOS_PATH . '/template-parts/sidebar.php' );
        ?> </div> <?php

        load_template(TODOS_PATH . '/template-parts/footer.php' );
    }
}