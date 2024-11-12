<?php
session_start();

$response = [];

if (isset($_SESSION['addNames'])) {
    

        $response['#msg'] = "All names are cleared";

    } else {
            $response['#msg'] = "Please add a name";
         }
    




?>