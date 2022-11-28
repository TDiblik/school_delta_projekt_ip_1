</head>
<div class="container">
    <h1>404: Not Found</h1>
    <p>Stránka nenalezena </p>
    <?php
        http_response_code(404);
        die();
    ?>
</div>