<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quill Editor</title>
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</head>
<body>
  <div id="editor"></div>
  <form id="editor-form" method="POST" action="your-server-endpoint.php">
    <input type="hidden" name="editor-text" id="editor-text">
    <input type="hidden" name="editor-images" id="editor-images">
    <button type="submit">Submit</button>
  </form>
  <script>
    var quill = new Quill('#editor', {
      theme: 'snow'
    });

    var form = document.getElementById('editor-form');
    form.onsubmit = function() {
      var editorContent = document.querySelector('.ql-editor').innerHTML;
      var parser = new DOMParser();
      var doc = parser.parseFromString(editorContent, 'text/html');

      // Extract text content
      var textContent = doc.body.innerText;

      // Extract images in base64 format
      var images = [];
      var imageElements = doc.querySelectorAll('img');
      imageElements.forEach(function(img) {
        images.push(img.src);
      });

      // Set the hidden input values
      document.getElementById('editor-text').value = textContent;
      document.getElementById('editor-images').value = JSON.stringify(images);
    };
  </script>
</body>
</html>