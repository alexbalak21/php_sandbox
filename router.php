<?php

function run_router()
{

    $requested_uri = $_SERVER['REQUEST_URI'];
    $requested_method = $_SERVER['REQUEST_METHOD'];
    switch ($requested_uri) {
        case "/":
        case "":
            require "./views/home.php";
            break;

        case "/about":
            require "./views/about.php";
            break;

        case "/user":
            require "./views/user.php";
            break;

        case "/page":
            require "./views/page.php";
            break;

        default:
            http_response_code(404);
            require "./views/404.php";
            break;
    }
}
