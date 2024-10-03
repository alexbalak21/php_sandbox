<?php
require_once "autoload.php";


$userModel = new model\User();
$userModel->sayHello();

$userController = new controller\User();
$userController->sayHello();
