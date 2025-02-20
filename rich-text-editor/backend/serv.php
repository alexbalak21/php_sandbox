<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $editorText = $_POST['editor-text'];
  $editorImages = json_decode($_POST['editor-images'], true);

  // Process the text content
  echo "Text content received: " . htmlspecialchars($editorText) . "<br>";

  // Process the images
  echo "Images received:<br>";
  foreach ($editorImages as $image) {
    echo '<img src="' . htmlspecialchars($image) . '" alt="Image"><br>';
  }
}
?>