<?php
require_once '.../classes/PdoMethods.php';

$pdoMethods = new pdoMethods();
$sql = "SELECT file_name, file_path FROM UploadedFiles";
$fileLinks = $pdoMethods->selectNotBinded($sql);
?>
