<?php
require_once "../SESSION/session.php";


$username = $_SESSION['username'] ?? NULL;


if ($username === NULL)
    echo "<h1>No USER</h1>";
else echo "<h1>$username</h1>";
