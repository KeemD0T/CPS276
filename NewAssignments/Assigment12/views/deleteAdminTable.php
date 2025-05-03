<?php
require_once('controllers/deleteAdminProc.php');

function init() {
    $output = "";
    
    if(isset($_POST['deleteCheck'])) {
        if(isset($_POST['deleteAdmin'])) {
            $output = deleteAdmins($_POST['deleteAdmin']);
        }
        else {
            $output = "You must select at least one administrator to delete";
        }
    }

    $output .= getAdmins();

    return <<<HTML
    <div class="container mt-5">
        <h2>Delete Administrators</h2>
        <p>Select the administrators you wish to delete</p>
        $output
    </div>
HTML;
}
?>
