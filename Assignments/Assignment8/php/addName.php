<?php
session_start();

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_POST = json_decode(file_get_contents('php://input'), true);
    if (isset($_POST['name'])) {
        if (empty($_POST['name'])) {
            $response['#msg'] = "Please add a name";
        } else {
            if (!isset($_SESSION['#addName'])) {
                $_SESSION['#addName'] = [];
            }
            $_SESSION['#addName'][] = htmlspecialchars($_POST['name']);
            $response['#msg'] = "Name(s) added: " . htmlspecialchars($_POST['name']);
        }
    } else {
        $response['#msg'] = "No name provided.";
    }

}
echo json_encode($response);
?>
