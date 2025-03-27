<?php
session_start();
require_once "listFilesProc.php"; // Include the file listing logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>List of Files</h1>
        <p><a href="file_upload.php">Add File</a></p>
        
        <?php if (is_array($fileList) && count($fileList) > 0): ?>
            <ul class="list-group">
            <?php foreach($fileList as $file): ?>
                <li class="list-group-item">
                    <a href="<?php echo htmlspecialchars($file['file_path']); ?>" target="_blank">
                        <?php echo htmlspecialchars($file['file_name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No files have been uploaded yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
