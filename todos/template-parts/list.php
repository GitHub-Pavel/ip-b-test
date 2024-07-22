<?php
/**
 * @var array $args
 */

use Todos\Dtos\TodoDto;

/**
 * @var TodoDto[] $todos
 */
$todos = $args['todos'] ?? [];

?>

<table class="wp-list-table widefat fixed striped table-view-list todos">
    <caption class="screen-reader-text">Table ordered by Date. Descending.</caption>
    <thead>
        <tr>
            <td id="cb" class="manage-column column-cb check-column">
                <input id="cb-select-all-1" type="checkbox" name="todos-all">
                <label for="cb-select-all-1">
                    <span class="screen-reader-text">Select All</span>
                </label>
            </td>
            <th scope="col" id="title" class="manage-column column-title column-primary sortable desc" abbr="Title">
                <span class="todos-col">Title</span>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($todos as $todo) : ?>
            <tr id="todo-<?=$todo->id?>" class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-uncategorized">
                <th scope="row" class="check-column">
                    <input
                        id="cb-select-<?=$todo->id?>"
                        type="checkbox"
                        name="todo"
                        value="<?=$todo->id?>"
                        <?php if ($todo->completed) : ?>
                            checked
                        <?php endif; ?>
                    >
                    <label for="cb-select-<?=$todo->id?>">
                        <span class="screen-reader-text"><?=$todo->title?></span>
                    </label>
                    <div class="locked-indicator">
                        <span class="locked-indicator-icon" aria-hidden="true"></span>
                        <span class="screen-reader-text">“<?=$todo->title?>” is locked</span>
                    </div>
                </th>
                <td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
                    <strong><?=$todo->title?></strong>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

    <tfoot>
    <tr>
        <td class="manage-column column-cb check-column">
            <input id="cb-select-all-2" type="checkbox" name="todos-all">
            <label for="cb-select-all-2">
                <span class="screen-reader-text">Select All</span>
            </label>
        </td>
        <th scope="col" class="manage-column column-title column-primary sortable desc" abbr="Title">
            <span class="todos-col">Title</span>
        </th>
    </tfoot>

</table>