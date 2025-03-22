<?php

//calls the database
require_once "Db_conn.php";

//class fileUploadProc{
   
   
   // Processes the form
  // public function addFile($FileName , $FileUploaded){
   
       $msg = ''; //message for the user
        $fileLink = ''; //locates the updated file
   
   //checks if the form was submited via button
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitButton'])) {

        $FileName = $_POST['FileName'];//gets the file name from the form
        $uploadedFile = $_FILES['file']; //gets the detials of the file 
        $uploadDir = 'files/'; // this is the directory where the files are
           $filepath = $uploadDir . basename($uploadedFile['name']); //this is the full path to tfile
           
           if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

             // Creates the directory
             if (move_uploaded_file($uploadedFile['tmp_name'], $filePath)) {
                try {
                    // Connect to the database
                    $db = new Db_conn();
                    $conn = $db->dbOpen();
        
                    // Insert the file details into the database
                    $stmt = $conn->prepare("INSERT INTO files (file_name, file_path) VALUES (:fileName, :filePath)");
                    $stmt->bindParam(':fileName', $FileName, PDO::PARAM_STR);
                    $stmt->bindParam(':filePath', $filePath, PDO::PARAM_STR);
                    
                    //Executes query to inser file details into the database
                    if ($stmt->execute()) {
                        $msg = "File '$FileName' uploaded successfully and saved to the database.";
                        $fileLink = $filePath; // Store the path for later use in the form
                    } else {
                        $msg = "File uploaded but failed to save in the database.";
                    }
                    //
                } catch (PDOException $e) {
                    $msg = "Database error: " . $e->getMessage();
                }
            } else {
                $msg = "File upload failed.";
            }
        }
   ?>