<?php
require_once("uuid.php");
$uuid = gen_uuid();
session_id($uuid);
session_start();
$_SESSION["username"] = "Alex";
$_SESSION["sid"] = $uuid;

echo "<br>";
echo "<br>";

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

</body>

</html>