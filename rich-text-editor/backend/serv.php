<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $editorContent = $_POST['editor-content'];
  // Process the content, e.g., save to a database or file
  
  echo "<h3>Raw Content</h3>" . htmlspecialchars($editorContent) . "<hr>" ;

  echo "<h3>Html Content</h3>" . $editorContent;
}
else{
  echo "<h3>Band Request</h3>";
}
?>