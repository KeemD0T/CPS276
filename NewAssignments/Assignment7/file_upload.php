<?php

require_once "fileUploadProc.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    
  </head>
  <body>

  <h1>File Upload</h1>
  
<!-- Display message -->
<div>
            <?php if (isset($msg)) { echo $msg; } ?>
            <?php if (!empty($fileLink)) { ?>
                <p><a href="<?php echo $fileLink; ?>" target="_blank">View Uploaded File</a></p>
            <?php } ?>
        </div>
    <form method="POST" action = "" enctype="multipart/form-data"> 

<div class="mb-3">
  <label for="dirName" class="form-label">File Name</label>
  <input type="text" class="form-control" name= "FileName" id="FileName" placeholder="">
</div>

<div class="mb-3">
        <input type="file" name="file" id="file" required>    
</div>

<button name ='submitButton' type="submit" class="btn btn-primary">Submit</button>
    </form> 
    
    
    
    
    </body>
</html>