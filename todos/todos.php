<?php

/**
 * Plugin Name: Todos
 *
 * Author:      Pavel K.
 *
 * Text Domain: ip-b
 * Domain Path: ./languages/
 *
 * Requires at least: 6.0
 * Requires PHP: 8.0
 *
 * Version:     1.0
 */

if ( !defined('ABSPATH') ) {
    return;
}

if ( !defined('TODOS_VERSION') ) {
    define('TODOS_VERSION', '1.0');
}

if ( !defined('TODOS_PATH') ) {
    define('TODOS_PATH', dirname(__FILE__) );
}

if ( !defined('TODOS_URL') ) {
    define('TODOS_URL', plugin_dir_url( __FILE__ ) );
}

require TODOS_PATH . '/vendor/autoload.php';
require TODOS_PATH . '/entities/index.php';
require TODOS_PATH . '/modules/index.php';
require TODOS_PATH . '/pages/index.php';


use Todos\Models\Todo;
use Todos\Pages\AdminPage;
use Todos\Modules\AppModule;
use Todos\Modules\TodosModule;
use Todos\Modules\LoggerService;
use Todos\Modules\ShortcodesModule;

$appModule = new AppModule(new LoggerService());

$appModule->migrate([new Todo()]);
$appModule->pages([new AdminPage()]);
$appModule->modules([
    new TodosModule(),
    new ShortcodesModule()
]);