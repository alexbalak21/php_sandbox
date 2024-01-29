<?php
require_once "get.php";

get("/", "./views/home.php");

get("/hello", function () {
    echo "Hello";
});

get('/user/name/$id', function ($name) {
    echo "Hello User named $name";
});
