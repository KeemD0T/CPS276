<?php

session_start();

if (!isset($_SESSION['names'])) {
    $_SESSION['names'] = [];
}

// Processes the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //adds a name if the add button is clicked
    if (isset($_POST['addName']) && !empty($_POST['name'])) {
        // Add name to session or array
        $_SESSION['names'][] = $_POST['name'];
    }
   
    return implode("\n", $_SESSION['names']);

    if (isset($_POST['sortNames'])) {
        
        sort($_SESSION['names']);
    }

    // activates if the Clear names button
    if (isset($_POST['clearNames'])) {
        // Clear names
        $_SESSION['names'] = [];
        echo "Session Cleared: ";
        var_dump($_SESSION['names']);
    }
}

function getNamesList() {
    return implode("\n", $_SESSION['names']);
}

?>
