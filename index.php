<?php

function exec_router()
{
    $requested_uri = $_SERVER['REQUEST_URI'];


    switch ($requested_uri) {
        case "/":
        case "":
            require "home.php";
            break;

        case "/about":
            require "about.php";
            break;

        case "/user":
            require "user.php";
            break;

        case "/page":
            require "page.php";
            break;

        default:
            http_response_code(404);
            require "404.php";
            break;
    }
}

exec_router();
