<?php
require_once 'crud.php';

// Function to generate a unique filename
function generate_unique_filename($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $unique_string = uniqid('', true) . microtime(true);
    $hashed_string = md5($unique_string);
    return $hashed_string . '.' . $extension;
}

// Function to handle file upload
function handle_file_upload() {
    $domain = '';
    $targetDir = "uploads/";
    $size = 5 * 1024 * 1024 * 1024; // 5 GB

    // Check if file is uploaded
    if (!isset($_FILES["fileToUpload"]) || !is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
        return "No file uploaded or invalid file.";
    }

    $filename = $_FILES["fileToUpload"]["name"];
    $unique_filename = generate_unique_filename($filename);
    $targetFile = $targetDir . $unique_filename;

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > $size) {
        return "Sorry, your file is too large.";
    }

    // Try to upload the file
    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        return "Sorry, there was an error uploading your file.";
    }

    $url = $domain . $targetFile;
    $category = $_POST['category'] ?? null;

    // Insert file URL into database
    if (insert_file_url($_POST['name'], $url, $category)) {
        return "" . $_POST['name'] . " has been uploaded.";
    } else {
        return "Failed to insert file URL into database.";
    }
}

// Handle file upload and display result
echo handle_file_upload();
?>
