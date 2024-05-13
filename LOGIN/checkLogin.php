<!-- IF LOGIN CORRECT SESSION START() -->
<?php
require_once '../SESSION/create_session.php';

$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";


function validate_user(string $username, string $password): void
{
    $db_user = [
        "name" => "alex",
        "password" => "root"
    ];
    if ($username === "" || $password === "")
        header('Location: login.php');
    // CHECK USERNAME AND password
    if ($username === $db_user['name'] && $password === $db_user['password']) {
        create_session($username);
        header('Location: page.php');
    } else header('Location: login.php');
}

validate_user($username, $password);
?>