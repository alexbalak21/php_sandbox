<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $editorHtml = $_POST['editor-html'];

  // Load the HTML content into a DOMDocument
  $dom = new DOMDocument();
  @$dom->loadHTML($editorHtml);

  // Extract image data and replace src with image ID
  $images = [];
  foreach ($dom->getElementsByTagName('img') as $img) {
    $src = $img->getAttribute('src');
    if (preg_match('/^data:(image\/\w+);base64,/', $src, $matches)) {
      $imageType = $matches[1]; // Extract the image type
      $base64Data = substr($src, strpos($src, ',') + 1); // Extract the base64 data

      // Save the image data to the database and get the image ID
      $stmt = $conn->prepare("INSERT INTO images_table (image_type, image_data) VALUES (?, ?)");
      $stmt->bind_param("ss", $imageType, $base64Data);
      $stmt->execute();
      $imageId = $stmt->insert_id;

      // Replace the src attribute with the image ID
      $img->setAttribute('src', 'image.php?id=' . $imageId);
    }
  }

  // Save the modified HTML content to the main table
  $modifiedHtml = $dom->saveHTML();
  $stmt = $conn->prepare("INSERT INTO main_table (content) VALUES (?)");
  $stmt->bind_param("s", $modifiedHtml);
  $stmt->execute();

  echo "Content and images saved successfully.";
}
?>