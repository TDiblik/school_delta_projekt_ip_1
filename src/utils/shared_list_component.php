<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        require_once __DIR__ . "/shared_headers.html";
        require_once __DIR__ . "/db_helper.php";
    ?>
    <title><?php echo $title;?></title>
</head>
<body>
    <div class="container">
        <h1><?php echo $title;?></h1>
        <?php
            $sort_column_param = $default_sort_column;
            $sort_direction_param = $default_sort_direction;

            if (isset($_GET["sort_column"]) && array_filter($column_names, function ($column) { return $column["db_name"] == $_GET["sort_column"]; })) {
                $sort_column_param = $_GET["sort_column"];
            }
            if (isset($_GET["sort_direction"]) && ($_GET["sort_direction"] == "asc" || $_GET["sort_direction"] == "desc")) {
                $sort_direction_param = $_GET["sort_direction"];
            }

            $connection = get_db_connection();
            $query = $connection->prepare("$base_query $sort_column_param $sort_direction_param");
            $query->execute();
        ?>
        <table class="table table-striped table-hover mb-4">
            <thead>
                <tr>
                    <?php
                        foreach ($column_names as $i => $column) {
                            $selected_arrow_style = "style=\"color: red;\"";
                            echo "<th>" . 
                                    $column["visible_name"] .
                                    "<a href=\"?sort_column=" . $column["db_name"] . "&sort_direction=asc" . "\"><i class=\"bi bi-arrow-down ms-2\"" . (($sort_column_param == $column["db_name"] && $sort_direction_param == "asc") ? $selected_arrow_style : "")  . "></i></a>" .
                                    "<a href=\"?sort_column=" . $column["db_name"] . "&sort_direction=desc" . "\"><i class=\"bi bi-arrow-up\"" . (($sort_column_param == $column["db_name"] && $sort_direction_param == "desc") ? $selected_arrow_style : "") . "></i></a>" .
                                 "</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($query as $row) {
                        echo "<tr>";
                        foreach ($column_names as $i => $column) {
                            echo "<td>";
                            
                            $is_link = isset($column["link"]);
                            if ($is_link) {
                                echo "<a href=\"" . $column["link"] . $row["id"] . "\"" . ">";
                            }
                            echo $row[$column["db_name"]];
                            if ($is_link) {
                                echo "</a>";
                            }

                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <a href="./index.php" style="float: right;">Zpět na index</a>
    </div>
</body>
</html>