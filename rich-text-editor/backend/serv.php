<?php
// Create or open the SQLite database
$db = new SQLite3('notes.db');

function parse_content_save_img(int $note_id = 0, string $content) : string {
  if (empty($content)) return "";
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
      $imageId = save_img_to_db($note_id, $imageType, $base64Data);
      // Replace the src attribute with the image ID
      $img->setAttribute('src', "id=$imageId");
    }
  }
   // Extract raw text without HTML tags
  $xpath = new DOMXPath($dom);
  $rawText = $xpath->evaluate("string(//body)");
  return $rawText;
  return $dom->saveHTML();
}

function init_note (string $title) : int {
global $db;
$stmt = $db->prepare("INSERT INTO notes (title) VALUES (:title)");
  $stmt->bindValue(':title', $title, MYSQLI_TYPE_VAR_STRING);
  $stmt->execute();
  return $db->lastInsertRowID();
}

function save_content(int $id = 0, string $content = '') : int {
  if ($id == 0 || $content == '') return 0;
  global $db;
  $stmt = $db->prepare("UPDATE notes SET content = :content WHERE id = :id");
  $stmt->bindValue(':content', $content, MYSQLI_TYPE_BLOB);
  $stmt->bindValue(':id', $id, MYSQLI_TYPE_INT24);
  $stmt->execute();
  return $id;
}

function save_img_to_db($note_id, $imageType, $base64Data) {
  global $db;
  // Save the image data to the database and get the image ID
  $stmt = $db->prepare("INSERT INTO images (image_type, image_data, note_id) VALUES (:image_type, :image_data, :note_id)");
  $stmt->bindValue(':image_type', $imageType, MYSQLI_TYPE_VAR_STRING);
  $stmt->bindValue(':image_data', $base64Data, MYSQLI_TYPE_BLOB);
  $stmt->bindValue(':note_id', $note_id, MYSQLI_TYPE_INT24);
  $stmt->execute();
  return $db->lastInsertRowID();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $note_id = init_note($_POST['title'] ?? '');
  $editor_content = parse_content_save_img($note_id, $_POST['editor-content'] ?? '');
  $id = save_content($note_id, $editor_content);
// Redirect browser
header("Location: http://localhost:3000/rich-text-editor/backend/read.php");
exit;
}
?>