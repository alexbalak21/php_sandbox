<?php
$servername = "localhost";
$username = "backend";
$password = "Azerty1239*";
$dbname = "notes";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
echo "Connected successfully";