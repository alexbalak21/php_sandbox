<?php
$uskey = !isset($_GET['uskey']) ? header('Location: /home') : $_GET['uskey'];

echo $uskey;
