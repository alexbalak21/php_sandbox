<?php
require_once "autoload.php";

use controller as c;
use model as m;
use app\src\repository as a;


$userModel = new m\User();
$userModel->sayHello();

$userController = new c\User();
$userController->sayHello();

$page = new a\Page();
$page->hello();
