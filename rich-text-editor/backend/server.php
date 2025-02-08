<?php
// Create (connect to) SQLite database in file
$db = new SQLite3('uploads.db');

// Create a table if it doesn't exist already
$db->exec("CREATE TABLE IF NOT EXISTS uploads (id INTEGER PRIMARY KEY, content TEXT)");

// Handle the upload POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $content = json_encode($input['content']); // Convert the content to JSON string

    $stmt = $db->prepare('INSERT INTO uploads (content) VALUES (:content)');
    $stmt->bindValue(':content', $content, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Content uploaded successfully!', 'id' => $db->lastInsertRowID()]);
    } else {
        echo json_encode(['error' => 'Error inserting content.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>