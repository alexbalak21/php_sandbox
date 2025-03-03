<?php

function method($method){
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    switch ($method) {
    case 'GET':
        # code...
        break;
    case 'POST':
        # code...
        break;
    case 'PUT':
        # code...
        break;
    case 'DELETE':
        # code...
        break;
    
    default:
        # code...
        break;
}
}

function GET($uri){

}

function POST($uri){

}

function PUT($uri){

}

function DELETE($uri){

}

?>