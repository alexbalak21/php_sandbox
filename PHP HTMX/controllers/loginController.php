<?php


$users = [['username' => "alex", "password" => password_hash("pass", PASSWORD_DEFAULT)]];

function serve()
{
    $username = "alex";
    $password = password_hash("pass", PASSWORD_DEFAULT);


    if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['username']) || !isset($_POST['password'])) {
        http_response_code(400);
        header("Content-Type: application/json");
        echo "Bad Request";
        return;
    }
    if (empty($_POST['username'])) {
        http_response_code(422);
        header("Content-Type: application/json");
        echo "Username is Empty";
        return;
    }
    if (empty($_POST['password'])) {
        http_response_code(422);
        header("Content-Type: application/json");
        echo "Password is Empty";
        return;
    }
    if (strtolower($_POST['username']) !== $username) {
        http_response_code(401);
        echo "User not found";
    } elseif (!password_verify($_POST['password'], $password)) {
        http_response_code(401);
        header("Content-Type: application/json");
        echo json_encode(['message' => "Incorrect Password"]);
        return;
    } else {
        http_response_code(201);
        session_start();
        $_SESSION['username'] = $username;
        header("Content-Type: application/json");
        echo json_encode(["redirect" => "posts.php"]);
        return;
    }
}
serve();
