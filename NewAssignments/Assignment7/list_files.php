<?php
require_once "listFilesProc.php"; // Include the file listing logic
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Uploaded Files</h1>
        <ul class="list-group">
            <<ul>
    <?php foreach ($fileList as $file): ?>
        <li>
            <a href="<?php echo $file['file_path']; ?>" target="_blank">
                <?php echo ($file['file_name']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

    </div>
</body>
</html>
