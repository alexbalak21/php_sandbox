<?php

function connect_db()
{
    $host = 'localhost'; // Change to your database host
    $dbname = 'uploads'; // Change to your database name
    $username = 'root'; // Change to your database username
    $password = ''; // Change to your database password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Set PDO to throw exceptions
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Handle connection error gracefully
        die("Connection failed: " . $e->getMessage());
    }
}
?>