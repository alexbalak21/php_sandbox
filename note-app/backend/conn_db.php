<?php
$servername = "localhost";
$username = "backend";
$password = "Azerty1239*";
$dbname = "notes";

// Define the DSN (Data Source Name)
$dsn = "mysql:host=$servername;dbname=$dbname";

try {
    $db = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    return null;
}

return $db;
?>