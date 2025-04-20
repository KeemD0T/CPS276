<?php
header('Content-Type: application/json');
require_once '../classes/Pdo_methods.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Check for empty name
        if(empty($data['name'])) {
            throw new Exception("Name cannot be empty");
        }

        $pdo = new PdoMethods();
        $sql = "INSERT INTO names (name) VALUES (:name)";
        // Fix bindings format to match your PDO class requirements
        $bindings = array(
            array(':name', $data['name'], 'str')
        );

        $result = $pdo->otherBinded($sql, $bindings);

        if($result === 'error'){
            throw new Exception("Error adding name to database");
        }

        $response['masterstatus'] = 'success';
        $response['msg'] = 'Name added successfully';

    } catch(Exception $e) {
        $response['masterstatus'] = 'error';
        $response['msg'] = $e->getMessage();
    }
    
    echo json_encode($response);
}
?>