<?php
require_once "autoload.php";

use controller as c;
use model as m;

$userModel = new m\User();
$userModel->sayHello();

$userController = new c\User();
$userController->sayHello();
