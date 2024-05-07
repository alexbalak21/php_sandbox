<?php
require_once "session.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <h1>Index</h1>
    <a href="index.php">Index</a>
    <a href="page.php">Page</a>
    <h3><?= session_id() ?></h3>


</body>

</html>