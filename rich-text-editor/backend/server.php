<?php
// Create (connect to) SQLite database in file
$db = new SQLite3('uploads.db');

// Create a table if it doesn't exist already
$db->exec("CREATE TABLE IF NOT EXISTS images (id INTEGER PRIMARY KEY, image BLOB)");

// Handle the upload POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $blob = file_get_contents($file['tmp_name']);
        
        $stmt = $db->prepare('INSERT INTO images (image) VALUES (:image)');
        $stmt->bindValue(':image', $blob, SQLITE3_BLOB);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Image uploaded successfully!', 'id' => $db->lastInsertRowID()]);
        } else {
            echo json_encode(['error' => 'Error inserting BLOB.']);
        }
    } else {
        echo json_encode(['error' => 'No file uploaded.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method or no file uploaded.']);
}
?>
