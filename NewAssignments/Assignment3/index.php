<?php
// Include the functions for adding and clearing names
require_once 'processNames.php';

$output = getNamesList();  // Initialize the output variable

//Handle form submisssion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
   
  //if the add button is clicked
  // everything here is done in processName
  if (isset($_POST['addName'])) {
    // Get the name from the form
      

  } elseif (isset($_POST['clearNames'])) {
     $_SESSION['names'] = []; //clears names
     $output = getNamesList(); // refreshes the list
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Add Display and Delete Names</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

  <div id="wrapper" >
    <h1>Add Names</h1>
    <form id="nameForm" action="index.php" method="POST">

      <div class="form-group">
        <input type="submit" id="addName" class="btn btn-primary" value="Add Names" name ="addName">
        <input type="submit" id="clearNames" class="btn btn-primary" value="Clear Names" name ="clearNames">
      </div>

      <div class="form-group">
        <label for="flname">Enter Name</label>
        <input type="text" id="flname" name="name" class="form-control"><br>
      </div>
      
      <div class="form-group">
        <label for="exampleTextarea" class="form-label">List of Names</label>
        <textarea style = "height: 500px;" class="form-control" name ="namelist" id="namelist" 
       placeholder="Here will be the list of names">
      
       <?php echo "\n". ($output); ?>

      </textarea>
      </div>

      

      <!--<textarea style="height: 500px;" class="form-control"
      id="namelist" name="namelist"><//?php echo $output ?></textarea> -->

    </form>
  </div>
</body>
</html>
