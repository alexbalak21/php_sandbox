<?php
// require_once "autoloader.php";
require_once "auto_loader.php";

$userModel = new model\User();
$userModel->sayHello();

$userController = new controller\User();
$userController->sayHello();
