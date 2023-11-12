<?php
require_once "get.php";

get("/", "./views/home.php");

get("/hello", function () {
    echo "Hello";
});
