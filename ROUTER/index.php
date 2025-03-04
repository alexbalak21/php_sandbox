<?php
require_once "Router.php";


define('BASE_URI', '/' . basename(__DIR__) . '/');
$Router = new Router();

$Router->GET('/ROUTER/', function($request, $response) {
    $response->Body("Home");
    $response->send();
});
?>