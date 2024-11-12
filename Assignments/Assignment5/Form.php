<?php

$output = "";
$fullPath = "";
$link ="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require_once 'Class.php';
  //$folder = new Directories();
  //$dirName = $_POST['dirName'];
  //$fileContent = $_POST['fileContent'];

  if (isset($_POST['dirName']) && isset($_POST['fileContent'])) {
    $dirName = $_POST['dirName'];
    $fileContent = $_POST['fileContent'];

    $folder = new Directories();
    //
    
  if ($output){
    $fullPath = $output;
    // the <a> tag concentrates strings a variables. The period operator in PHP is used for string conatenation
    //<a href='URL' target='_blank'>Link Text</a> This is basic link anchor tag. The href goes to target='blank'


    $link = "<a href='" . ($fullPath) . "' target='_blank'>Path where file is located</a>";
  } else {
    $link = "A directory already exits with that name";
          }
        } else {
    $link ="error  ";
        }
  
 }  

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

  <h1>File and  Directory Assignment</h1>
  <p>Enter a folder name of a file. Folder names contain alpha numeric charaters only</P>
  
        <p><?php echo $link; ?></p>
    
  

    <form method="POST" action="Form.php">
<div class="mb-3">
  <label for="dirName" class="form-label">Folder Name</label>
  <input type="text" class="form-control" name= "dirName" id="dirName" placeholder="">
</div>

<div class="mb-3">
  <label for="fileContent" class="form-label">Example text area</label>
  <textarea class="form-control" id="fileContent" name ='fileContent'rows="3"></textarea>
</div>

<button name ='submitButton'type="submit" class="btn btn-primary">Submit</button>
    </form > 
    
    
    
    
    </body>
</html>
