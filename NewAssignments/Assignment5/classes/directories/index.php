

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    
  </head>
  <body>

  <h1>File and  Directory Assignment</h1>
  <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only</p>

  <div><?php echo $msg; ?></div>

    <p><a href="<?php echo $fileLink; ?>" target="_blank">Path where the file is located</a></p>


    <form method="POST">

<div class="mb-3">
  <label for="dirName" class="form-label">Folder Name</label>
  <input type="text " class="form-control" name= "FolderName" id="FolderName" placeholder="">
</div>

<div class="mb-3">
  <label for="fileContent" class="form-label">File contents</label>
  <textarea class="form-control" id="fileContent" name ='fileContent'rows="3"></textarea>
</div>

<button name ='submitButton'type="submit" class="btn btn-primary">Submit</button>
    </form> 
    
    
    
    
    </body>
</html>