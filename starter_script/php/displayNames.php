<?php
header('Content-Type: application/json');
require_once '../classes/Pdo_methods.php';

$response = array();

try {
    $pdo = new PdoMethods();
    
    // Select and order by name as shown in your sample data
    $sql = "SELECT name FROM names ORDER BY name";
    $records = $pdo->selectNotBinded($sql);
    
    if($records === 'error') {
        throw new Exception("Error retrieving names from database");
    }

    // Create HTML list of names
    $html = '<ul>';
    foreach($records as $row) {
        $html .= '<li>' . htmlspecialchars($row['name']) . '</li>';
    }
    $html .= '</ul>';

    $response['masterstatus'] = 'success';
    $response['names'] = $html;

} catch(Exception $e) {
    $response['masterstatus'] = 'error';
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>