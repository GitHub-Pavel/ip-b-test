<?php

namespace Todos\Instances;

class Model {
    public string $charset;
    public string $table_name;

    public function __construct($table_name)
    {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $this->charset = $wpdb->get_charset_collate();
        $this->table_name = $wpdb->prefix . $table_name;
    }
}