<?php
require_once('classes/Pdo_methods.php');

function getAdmins() {
    $pdo = new PdoMethods();
    $sql = "SELECT id, firstName, lastName, email, status FROM admin ORDER BY lastName";
    $records = $pdo->selectNotBinded($sql);

    if($records == 'error') {
        return 'There has been an error processing your request';
    }
    else {
        if(count($records) != 0) {
            return createAdminTable($records);
        }
        else {
            return 'No administrators found';
        }
    }
}

function createAdminTable($records) {
    $output = '<form method="post" action="">';
    $output .= '<table class="table table-bordered table-striped">';
    $output .= '<thead><tr>';
    $output .= '<th>Name</th>';
    $output .= '<th>Email</th>';
    $output .= '<th>Status</th>';
    $output .= '<th>Delete</th>';
    $output .= '</tr></thead><tbody>';
    
    foreach($records as $row){
        $output .= '<tr>';
        $output .= '<td>' . $row['lastName'] . ', ' . $row['firstName'] . '</td>';
        $output .= '<td>' . $row['email'] . '</td>';
        $output .= '<td>' . $row['status'] . '</td>';
        $output .= '<td><input type="checkbox" name="deleteAdmin[]" value="' . $row['id'] . '"></td>';
        $output .= '</tr>';
    }
    
    $output .= '</tbody></table>';
    $output .= '<input type="submit" class="btn btn-danger" name="deleteCheck" value="Delete Selected Administrators">';
    $output .= '</form>';
    
    return $output;
}

function deleteAdmins($idArray) {
    $pdo = new PdoMethods();
    $ids = implode(',', $idArray);
    
    $sql = "DELETE FROM admin WHERE id IN ($ids)";
    $result = $pdo->otherNotBinded($sql);

    if($result === 'error') {
        return 'There was an error deleting the administrators';
    }
    else {
        return 'Administrators have been deleted';
    }
}
?>
