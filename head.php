<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
$headers = getallheaders();
$authorization = isset($headers['Authorization']) ? $headers['Authorization'] : $headers['authorization'];
$json = "{";



foreach ($headers as $key => $value) {
    $json .= <<<JSN
    "$key": "$value";
    JSN;
}
$json .= "}";
// echo $json;
$auth = array("Authorization" => $authorization);
echo json_encode($auth);


print_r($_POST);
