<?php


$servername = "localhost";
$username = "backend";
$password = "Azerty1239*";
$dbname = "notes";


try {
  $db = new mysqli($servername, $username, $password, $dbname);
} catch (\Throwable $th) {
  echo "Connection failed: " . $db->connect_error;
  return null;
}
