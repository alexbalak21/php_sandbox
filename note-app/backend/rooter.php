<?php
function rest_api(){
    $json = file_get_contents('php://input');
    header('Content-Type: application/json; charset=UTF-8');
echo json_encode(
    ["method" => $_SERVER['REQUEST_METHOD'], "uri" => urldecode($_SERVER['REQUEST_URI']), "body"=>json_decode($json)],
    JSON_UNESCAPED_SLASHES
);


}

function http_response(){
    echo $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'];
    echo "<br>";
    foreach ($_POST as $key => $value) {
    echo "$key : $value<br>";
}
}
?>