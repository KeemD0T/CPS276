<?php
session_start();

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST = json_decode(file_get_contents('php://input'), true);
    
    if (isset($_POST['datetime']) && isset($_POST['note'])) {
        if (empty($_POST['datetime']) || empty($_POST['note'])) {
            $response['msg'] = "You must enter a date, time, and note.";
        } else {
            $timestamp = $_POST['datetime'];
            $note = htmlspecialchars($_POST['note']);
            
            // Connect to the database
            $conn = new mysqli('localhost', 'username', 'password', 'database');
            
            if ($conn->connect_error) {
                $response['msg'] = 'Database connection failed: ' . $conn->connect_error;
            } else {
                $stmt = $conn->prepare("INSERT INTO notes (timestamp, note) VALUES (?, ?)");
                $stmt->bind_param('is', $timestamp, $note);
                if ($stmt->execute()) {
                    $response['msg'] = "Note added successfully.";
                } else {
                    $response['msg'] = 'Database insert failed: ' . $stmt->error;
                }
                $stmt->close();
                $conn->close();
            }
        }
    } else {
        $response['msg'] = "No data provided.";
    }
}
echo json_encode($response);
?>
