<?php
// Include the database connection
require_once "Db_conn.php";

$fileList = []; // Initialize the file list

try {
    // Connect to the database
    $db = new Db_conn();
    $conn = $db->dbOpen();

    // Query the files table to get the list of files
    $stmt = $conn->prepare("SELECT file_name, file_path FROM files ORDER BY uploaded_at DESC");
    $stmt->execute();

    // Fetch all files as an associative array
    $fileList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching files: " . $e->getMessage();
}
?>
