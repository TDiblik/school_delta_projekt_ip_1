</head>
<div class="container">
    <h1>400: Bad request</h1>
    <p>Request neměl správný formát</p>
    <?php
        http_response_code(400);
        die();
    ?>
</div>