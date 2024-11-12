<?php
session_start();
$response = [];
//require_once 'addNames.php';

if (isset($_POST['displayNames'])) {
    $response['names'] = [];

    //echo "<h2>Entered Names:</h2><ul>";
    if(isset($_SESSION['addName'])){
        foreach ($_SESSION['addName'] as $name) {
            $response['names'][] = htmlspecialchars($name);
    }
}
echo json_encode($response);
    }

?>