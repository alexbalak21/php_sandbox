<?php
require_once "db.php";
$DB = new DB();

function serve(){
  global $DB;
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  $editorContent = $_POST['editor-content'] ?? '';
  else
      header('HTTP/1.1 401 Unauthorized');
  if (empty($editorContent)) return;
  $title = $_POST['title'] ?? '';
  $note_id = $DB->init_note($title);
}


function save_note(){
  global $DB;
  $content = $_POST['editor-content'] ?? '';
  $title = $_POST['title'] ?? 'Unnamed note';
  if ($content) return "Can not save empty note";
  $note_id = $DB->init_note($title);
  $dom = new DOMDocument();
  @$dom->loadHTML($content);
  $images = $dom->getElementsByTagName('img');
  if ($images->length > 0) 
    foreach ($images as $img) {
      $src = $img->getAttribute('src');
      if (preg_match('/^data:(image\/\w+);base64,/', $src, $matches)) {
        $imageType = $matches[1]; // Extract the image type
        $base64Data = substr($src, strpos($src, ',') + 1); // Extract the base64 data
        // $imageId = save_img_to_db($note_id, $imageType, $base64Data);
        // Replace the src attribute with the image ID
        // $img->setAttribute('src', "id=$imageId");
      }
}
}

function parse_content_save_img(int $note_id = 0, string $content) : string {
  if (empty($content)) return "";
  // Load the HTML content into a DOMDocument with UTF-8 encoding
  $dom = new DOMDocument();
  @$dom->loadHTML($content);
  $images = $dom->getElementsByTagName('img');
  // if ($images->length === 0) return $content;
  // Extract image data and replace src with image ID
  foreach ($images as $img) {
    $src = $img->getAttribute('src');
    if (preg_match('/^data:(image\/\w+);base64,/', $src, $matches)) {
      $imageType = $matches[1]; // Extract the image type
      $base64Data = substr($src, strpos($src, ',') + 1); // Extract the base64 data
      // $imageId = save_img_to_db($note_id, $imageType, $base64Data);
      // Replace the src attribute with the image ID
      // $img->setAttribute('src', "id=$imageId");
    }
  }
  extract_raw_text($dom);
  return $dom->saveHTML();
}

function extract_raw_text($html_content) : string {
    // Extract raw text without HTML tags
  $xpath = new DOMXPath($html_content);
  $rawText = $xpath->evaluate("string(//body)");
  // Convert the raw text to UTF-8 encoding
  $rawText = iconv('UTF-8', 'ISO-8859-1' . '//IGNORE', $rawText);
  echo $rawText;
  return $rawText;
}

$id = $db->init_note("test");

echo $id;
?>