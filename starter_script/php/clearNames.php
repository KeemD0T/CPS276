<?php
header('Content-Type: application/json');
require_once '../classes/Pdo_methods.php';

$response = array();

try {
    $pdo = new PdoMethods();
    
    // Delete all records
    $sql = "DELETE FROM names";
    $result = $pdo->otherNotBinded($sql);
    
    if($result === 'error') {
        throw new Exception("Error clearing names from database");
    }

    $response['masterstatus'] = 'success';
    $response['msg'] = 'All names have been cleared';

} catch(Exception $e) {
    $response['masterstatus'] = 'error';
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>