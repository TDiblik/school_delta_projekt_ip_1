<?php
    $title = "Seznam zaměstnanců";
    $default_sort_column = "employee_name";
    $default_sort_direction = "asc";
    $column_names = [
        ["db_name" => "employee_name", "visible_name" => "Jméno", "link" => "./employee.php?id="],
        ["db_name" => "room_name", "visible_name" => "Místnost"],
        ["db_name" => "room_telephone", "visible_name" => "Telefon"],
        ["db_name" => "job_title", "visible_name" => "Pozice"],
    ];
    $base_query = 
        "select e.id as id, concat(e.first_name, ' ', e.last_name) as employee_name, r.name as room_name, r.telephone as room_telephone, j.name as job_title from employees as e
            left join rooms r on e.room_id = r.id
            left join job_titles j on e.job_title_id = j.id
        order by ";

    require_once __DIR__ . '/utils/shared_list_component.php';
?>