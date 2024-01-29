<?php
$title = "404";
require_once("./components/navigation.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <?= nav() ?>
    <h1><?= $title ?></h1>

</body>

</html>