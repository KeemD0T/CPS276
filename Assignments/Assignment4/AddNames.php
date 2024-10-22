<?php
$names = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['name']);
    if ($fullName) {
        list($firstName, $lastName) = explode(' ', $fullName);
        $names[] = ['firstName' => $firstName, 'lastName' => $lastName];
        displayNames($names);
    }
}

function displayNames($names) {
    usort($names, function($a, $b) {
        return strcmp($a['lastName'], $b['lastName']) ?: strcmp($a['firstName'], $b['firstName']);
    });
    foreach ($names as $name) {
        echo "{$name['lastName']}, {$name['firstName']}<br>";
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>
  <form method="post">
        <label for="name">Enter First and Last Name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit" name="add">Add Name</button>
        <button type="submit" name="clear">Clear Names</button>
    </form>
  </body>
</html>';