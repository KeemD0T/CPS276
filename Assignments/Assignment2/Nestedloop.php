<?php
// Function to create a nested list
function createNestedList($num1, $num2) {
    $mainList = array(
        1,
        array(1,2,3,4,5),
        2,
        array(1,2,3,4,5),
        3,
        array(1,2,3,4,5),
        4,
        array(1,2,3,4,5),
        5,
        array(1,2,3,4,5),
        
        
    );

    $html = '<ul>';
    foreach ($mainList as $item) {
        if (is_array($item)) {
            $html .= '<li><ul>';
            foreach ($item as $subItem) {
                $html .= '<li>' . $subItem . '</li>';
            }
            $html .= '</ul></li>';
        } else {
            $html .= '<li>' . $item . '</li>';
        }
    }
    $html .= '</ul >';

    return $html;
}

// Example numbers
$num1 = 1 ;
$num2 = 5;

// Create the nested list HTML
$nestedListHTML = createNestedList($num1, $num2);
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
   echo $nestedListHTML;
    ?>
  </body>
</html>';

