<?php
// Create or open the SQLite database
$db = new SQLite3('notes.db');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $editor_content = $_POST['editor-content'];

  // Load the HTML content into a DOMDocument
  $dom = new DOMDocument();
  @$dom->loadHTML($editor_content);

  // Extract image data and replace src with image ID
  $images = [];
  foreach ($dom->getElementsByTagName('img') as $img) {
    $src = $img->getAttribute('src');
    if (preg_match('/^data:(image\/\w+);base64,/', $src, $matches)) {
      $imageType = $matches[1]; // Extract the image type
      $base64Data = substr($src, strpos($src, ',') + 1); // Extract the base64 data

      // Save the image data to the database and get the image ID
      $stmt = $db->prepare("INSERT INTO images (image_type, image_data) VALUES (:image_type, :image_data)");
      $stmt->bindValue(':image_type', $imageType, SQLITE3_TEXT);
      $stmt->bindValue(':image_data', $base64Data, SQLITE3_BLOB);
      $stmt->execute();
      $imageId = $db->lastInsertRowID();

      // Replace the src attribute with the image ID
      $img->setAttribute('src', "id=$imageId");
    }
  }

  // Save the modified HTML content back to the $editor_content variable
  $editor_content = $dom->saveHTML();

  // Insert the modified HTML content into the notes table
  $stmt = $db->prepare("INSERT INTO notes (content) VALUES (:content)");
  $stmt->bindValue(':content', $editor_content, SQLITE3_TEXT);
  $stmt->execute();

  echo $editor_content;
}
?>