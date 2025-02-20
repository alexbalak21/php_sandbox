<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quill Editor</title>
    <link
      href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
      rel="stylesheet"
    />
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  </head>
  <body>
    <div id="editor"></div>
    <script>
      var quill = new Quill("#editor", {
        theme: "snow",
      });
    </script>
  </body>
</html>
