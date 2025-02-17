<?php
$output = '';
$numbers = range(1,50);
    //$output ="<ul>";
    foreach ( $numbers as $evenNumbers ){
        if ($evenNumbers % 2 == 0){
            //$output .="<li>($evenNumbers)</li>";
            $output .=" -$evenNumbers";
        }   
        //$output .= "</ul>";
      
    }

    $form = <<<EOD
<form>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="name@example.com">
    <div id="emailHelp" class="form-text">Please enter your email.</div>
  </div>
  
  <div class="mb-3">
    <label for="exampleTextarea" class="form-label">Example textarea</label>
    <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Type your text here"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
EOD;


    function createTable($rows, $columns){
        echo "<table class='table table-bordered'>";
       for ($i = 1; $i <= $rows; $i++) {
        echo "<tr>";
       for ($j = 1; $j <= $columns; $j++){
        echo "<td>Row $i,  col $j </td>";
        }
        echo "</tr>";
    }
echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body class ="container">
    <?php
    echo $output;
    echo $form;
    echo createTable(8,6);
    
    ?>
</body>
</html>