<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" defer crossorigin="anonymous"></script>
  <script src="https://unpkg.com/htmx.org@2.0.3"></script>
</head>

<body>
  <main class="container my-5">
    <div class="col-lg-4 mx-auto d-flex align-items-center justify-content-center card" style="height: 80vh;">
      <form hx-post="/controllers/loginController.php">
        <div class="text-center">
          <h4 class="text-danger" id="message"></h4>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="text-center"><button type="submit" class="btn btn-primary">Send</button></div>
      </form>
    </div>
    <div id="response"></div>
  </main>
  <script>
    document.addEventListener('htmx:afterRequest', function(evt) {
      let response = JSON.parse(evt.detail.xhr.response)
      console.log(evt.detail.xhr);
      if (evt.detail.failed) document.getElementById('message').innerText = response.message
      else console.log(response);

    });
  </script>

</body>

</html>