<?php
    $title = "Seznam místností";
    $default_sort_column = "room_name";
    $default_sort_direction = "asc";
    $column_names = [
        ["db_name" => "room_name", "visible_name" => "Název", "link" => "./room.php?id="],
        ["db_name" => "room_number", "visible_name" => "Číslo"],
        ["db_name" => "room_telephone", "visible_name" => "Telefon"],
    ];
    $base_query = "select id as id, name as room_name, number as room_number, telephone as room_telephone from rooms order by ";

    require_once __DIR__ . '/utils/shared_list_component.php';
?>