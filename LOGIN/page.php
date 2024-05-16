<?php
require_once "../SESSION/session.php";


$username = $_SESSION['username'] ?? NULL;

$test = ob_start(); ?>
<h1>test</h1>
<?php ob_get_clean();


if ($username === NULL)
    echo "<h1>No USER</h1>";
else echo "<h1>$username</h1>";
$test;
