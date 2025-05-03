<?php
require_once('classes/Db_conn.php');
require_once('classes/Pdo_methods.php');

$db = new DatabaseConn();
$pdo = new PdoMethods();

try {
    $conn = $db->dbOpen();
    
    // Check if admin table exists
    $sql = "SHOW TABLES LIKE 'admin'";
    $result = $pdo->selectNotBinded($sql);
    
    if (count($result) === 0) {
        echo "Admin table does not exist. Please run the SQL script to create it.";
    } else {
        // Check table structure
        $sql = "DESCRIBE admin";
        $structure = $pdo->selectNotBinded($sql);
        
        echo "Admin table exists with the following structure:<br>";
        foreach ($structure as $column) {
            echo "{$column['Field']} - {$column['Type']}<br>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 