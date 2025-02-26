<?php
// Create or open the SQLite database
$db = new SQLite3('notes.db');

function parse_content_save_img($content) {
  if (empty($content)) return "";
  global $db;
  // Load the HTML content into a DOMDocument
  $dom = new DOMDocument();
  @$dom->loadHTML($content);
  $images = $dom->getElementsByTagName('img');
  if ($images->length === 0) return $content;
  // Extract image data and replace src with image ID
  foreach ($images as $img) {
    $src = $img->getAttribute('src');
    if (preg_match('/^data:(image\/\w+);base64,/', $src, $matches)) {
      $imageType = $matches[1]; // Extract the image type
      $base64Data = substr($src, strpos($src, ',') + 1); // Extract the base64 data
      $imageId = save_img_to_db($imageType, $base64Data);
      // Replace the src attribute with the image ID
      $img->setAttribute('src', "id=$imageId");
    }
  }
  return $dom->saveHTML();
}

function save_content($content) : int {
  if ($content == '') return 0;
  global $db;
  $stmt = $db->prepare("INSERT INTO notes (content) VALUES (:content)");
  $stmt->bindValue(':content', $content, SQLITE3_TEXT);
  $stmt->execute();
  return $db->lastInsertRowID();
}

function save_img_to_db($imageType, $base64Data) {
  global $db;
  // Save the image data to the database and get the image ID
  $stmt = $db->prepare("INSERT INTO images (image_type, image_data) VALUES (:image_type, :image_data)");
  $stmt->bindValue(':image_type', $imageType, SQLITE3_TEXT);
  $stmt->bindValue(':image_data', $base64Data, SQLITE3_BLOB);
  $stmt->execute();
  return $db->lastInsertRowID();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $editor_content = parse_content_save_img($_POST['editor-content'] ?? '');
  $id = save_content($editor_content);
  echo $editor_content;
}
?>