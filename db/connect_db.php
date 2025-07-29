<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myDB";

function connect_db()
{
    global $servername, $username, $password, $database;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    } finally {
        $conn = null; // Close the connection
    }
}
