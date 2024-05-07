<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPONENTS TEST</title>
</head>

<body>
    <h1>Components Test</h1>

    <?php
    $content = "Some content for test";

    $test = require_once "components/div.html";

    echo $test;
    ?>

</body>

</html>