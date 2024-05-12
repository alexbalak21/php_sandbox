<?php
// CRUD
require_once 'database.php';

function insert_file_url($filename, $url, $category = "") {
    $conn = connect_db();
    if ($conn === null) {
        return false; // Unable to connect to the database
    }

    // Sanitize and convert category to an integer
    $category_id = $category === "" ? NULL : intval($category);

    // Prepare the SQL statement
    $sql = "INSERT INTO files (filename, url, category_id) VALUES (:filename, :url, :category_id)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':filename', $filename);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT); // Bind as integer

    try {
        // Execute the statement and return true if successful
        return $stmt->execute();
    } catch (PDOException $e) {
        // Log error message
        error_log("Error inserting file URL: " . $e->getMessage());
        return false; // Return false on failure
    }
}

function read_all_files(): Array{
    $conn = connect_db();
    if ($conn === null) {
        return []; // Return an empty array if unable to connect to the database
    }

    // Prepare the SQL statement to select all records from the "files" table
    $sql = "SELECT * FROM files";

    try {
        // Prepare and execute the SQL statement
        $stmt = $conn->query($sql);

        // Fetch all records as an associative array
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the fetched records
        return $files;
    } catch (PDOException $e) {
        // Log error message
        error_log("Error reading files: " . $e->getMessage());
        return []; // Return an empty array on failure
    }
}


function read_categories(): array {
    $conn = connect_db();
    if ($conn === null) {
        return []; // Return an empty array if unable to connect to the database
    }

    // Prepare the SQL statement to select all records from the "category" table
    $sql = "SELECT id, name FROM category";

    try {
        // Prepare and execute the SQL statement
        $stmt = $conn->query($sql);

        // Fetch all records as an associative array with category IDs as keys and category names as values
        $categories = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // Return the fetched records
        return $categories;
    } catch (PDOException $e) {
        // Log error message
        error_log("Error reading categories: " . $e->getMessage());
        return []; // Return an empty array on failure
    }
}
?>
