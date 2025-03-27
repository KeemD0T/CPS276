<?php

require_once "fileUploadProc.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container mt-5">
        <h1>File Upload</h1>
        <p><a href="list_files.php">View Files</a></p>

        <!-- Display message -->
        <?php if (!empty($msg)): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="FileName" class="form-label">File Name</label>
                <input type="text" class="form-control" name="FileName" id="FileName" required>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Select File</label>
                <input type="file" class="form-control" name="file" id="file" required>
            </div>

            <button name="submitButton" type="submit" class="btn btn-primary">Upload File</button>
        </form>
    </div>
  </body>
</html>