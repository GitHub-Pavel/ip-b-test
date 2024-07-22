<?php

namespace Todos\Modules;

use Psr\Log\LoggerInterface;
use Todos\Interfaces\ModuleInterface;
use Todos\Interfaces\PageInterface;
use Todos\Interfaces\ModelInterface;

class AppModule {
    private ?LoggerInterface $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->settings();
    }

    private function settings(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'front_assets']);
        add_action('admin_enqueue_scripts', [$this, 'admin_assets']);
    }

    public function admin_assets(): void
    {
        wp_enqueue_script( 'todos-admin-app', TODOS_URL . 'assets/app/admin.app.js', [], TODOS_VERSION );
        wp_enqueue_style( 'todos-admin-styles', TODOS_URL . 'assets/styles/admin.style.css', [], TODOS_VERSION );
    }

    public function front_assets(): void
    {
        wp_enqueue_style( 'todos-front-styles', TODOS_URL . 'assets/styles/front.style.css', [], TODOS_VERSION, true );
    }

    /**
     * @param ModelInterface[] $models
     */
    public function migrate(array $models): void
    {
        add_action('admin_init', function () use ($models) {
            foreach ($models as $model) {
                $model->migrate();
            }
        });
    }

    /**
     * @param PageInterface[] $pages
     */
    public function pages(array $pages): void
    {
        add_action('admin_menu', function () use ($pages) {
            foreach ($pages as $page) {
                $page->setLogger($this->logger);
                add_menu_page(
                    $page->name,
                    $page->name,
                    $page->capability,
                    $page->slug,
                    [$page, 'render'],
                    $page->icon,
                    $page->position
                );
            }
        });
    }

    /**
     * @param ModuleInterface[] $modules
     */
    public function modules(array $modules): void
    {
        foreach ($modules as $module) {
            $module->setLogger($this->logger);
            $module->init();
        }
    }
}