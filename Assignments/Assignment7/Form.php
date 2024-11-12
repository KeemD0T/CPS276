<?php
require_once 'fileUploadProc.php';
require_once 'listFilesProc.php';

$pdo___Methods = new pdo__methods(); 
$fileLinks = $pd___oMethods ->selectAll();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div>
<h1>File Upload</h1>
</div>

<form action = "fileUploadProc.php" method ="post" enctype ="multipart/form-data">
<div class="mb-3">
  <label for="fileName" class="form-label">File Name</label>
  <input type="text" class="form-control" name= "fileName" id="fileName" placeholder="">
</div>
 
<button for="fileUpload" class = "form-label">choose file </button >
<input type ="text" id="fileName" name="fileName"  placeholder = 'No file Chosen'required><br><br>
 
<button type="button" for="fileUpload" class="btn btn-primary">Upload file:</button>

 

</form>
<?php if (isset($message)): ?>
     <div class="alert alert-info mt-3">
          <?php echo $message; ?> </div> 
          <?php endif; ?> 
          <h2 class="mt-5">List of Files</h2>
           <ul> <?php if(!empty($fileLinks)): ?>
             <?php foreach ($fileLinks as $file): ?>
                 <li> <a href="<?php echo $file['file_path']; ?>" target="_blank"><?php echo $file['file_name']; ?></a> </li>
                  <?php endforeach; ?> 
                  <?php else: ?>
                     <li>No files uploaded yet.</li> 
                     <?php endif; ?>
                     </ul>
                  </div>

</body>
</html>