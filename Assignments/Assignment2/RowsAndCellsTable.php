
<?php
$numRows = 15; // Number of rows
$numCells = 5; // Number of cells per row

echo "<table border='2'>";

// Generate table headers
echo "<tr>";
for ($i = 1; $i <= $numCells; $i++) {
   
}
echo "</tr>";


// Generate table rows and cells
for ($row = 1; $row <= $numRows; $row++) {
    echo "<tr>";
    for ($cell = 1; $cell <= $numCells; $cell++) {
        echo "<td>Row $row Cell $cell</td>";
    }
    echo "</tr>";
}


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>
  <?php
    // Display the nested list HTML
    echo "</table>";
    ?>
  </body>
</html>';