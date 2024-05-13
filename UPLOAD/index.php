<?php
require_once "crud.php";
include_once "./table.php";
$files = read_all_files();
$categories = read_categories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <!-- Your local Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Upload File</h2>
                        <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="fileToUpload" class="form-label">Choose File</label>
                                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category" id="category">
                                    <option value=""></option>
                                    <?php foreach ($categories as $id => $category) : ?>
                                        <option value="<?= $id; ?>"><?= $category; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <div class="my-1 text-center">
                                    <h5 id="output"></h5>
                                </div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressBar"></div>
                            </div>
                            <div class="mb-1 text-center lead" id="progressText">0%</div>
                            <button type="submit" id="uploadButton" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5"><?= gen_table($files, $categories); ?></div>


    </div>
    <!-- Your local Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <script src="js/main.js" defer></script>
</body>

</html>