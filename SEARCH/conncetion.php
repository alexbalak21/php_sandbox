<?php

/**
 * Connects to the database.
 *
 * @return PDO|null The PDO object if successful, or null if connection fails.
 */

function connect_db(): PDO
{
    static $conn = null;

    if ($conn !== null) {
        return $conn;
    }

    $host = "localhost";
    $username = 'root';
    $password = '';
    $database = "search";
    $dsn = "mysql:host=$host;dbname=$database";

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}
