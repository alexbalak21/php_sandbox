<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $editorHtml = $_POST['editor-content'];

  // Load the HTML content into a DOMDocument
  $dom = new DOMDocument();
  @$dom->loadHTML($editorHtml);

  // Extract image data
  $images = [];
  foreach ($dom->getElementsByTagName('img') as $img) {
    $images[] = $img->getAttribute('src');
  }

  print_r($images);

  // // Save the HTML content to the main table
  // // Assuming you have a database connection $conn
  // $stmt = $conn->prepare("INSERT INTO main_table (content) VALUES (?)");
  // $stmt->bind_param("s", $editorHtml);
  // $stmt->execute();

  // // Save the image data to a different table
  // $stmt = $conn->prepare("INSERT INTO images_table (image_data) VALUES (?)");
  // foreach ($images as $image) {
  //   $stmt->bind_param("s", $image);
  //   $stmt->execute();
  // }

  echo "Content and images saved successfully.";
}
?>