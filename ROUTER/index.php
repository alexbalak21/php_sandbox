<?php
require_once "Rooter.php";

$rooter = new Rooter();

$rooter->GET('/ROUTER/', function($request, $response) {
    $response->Body("GET request to " . $request->uri);
    $response->send();
});
?>