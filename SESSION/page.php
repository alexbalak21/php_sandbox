<?php
session_start();

print_r($_SESSION["username"]);
echo "<br>";

echo "<br>";


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
</head>

<body>
    <h1>Page</h1>
    <a href="index.php">Index</a>
    <a href="page.php">Page</a>

</body>

</html>