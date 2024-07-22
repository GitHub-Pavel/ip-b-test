<?php

namespace Todos\Modules;

use Todos\Instances\WithLogger;

class ShortcodeService extends WithLogger {
    public function todos(mixed $atts): string
    {
        global $wpdb;

        $args = gettype($atts) === 'array' ? $atts : [];
        $table_name = $wpdb->prefix . 'todos';
        [
            'limit' => $count,
            'completed' => $completed,
        ] = array_merge([
            'limit' => 5,
            'completed' => null,
        ], $args);

        $completed_sql = '';
        if ($completed === 'true') {
            $completed_sql = " AND completed = true";
        }
        if ($completed === 'false') {
            $completed_sql = " AND completed = false";
        }

        $result = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM $table_name WHERE 1=1
            $completed_sql
            LIMIT $count
        "));

        return json_encode($result ?? []);
    }
}