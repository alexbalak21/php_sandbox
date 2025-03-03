<?php
require_once "Rooter.php";
$rooter = new Rooter();

$rooter->GET("/", function () {
    echo "Hello World!";    });

?>