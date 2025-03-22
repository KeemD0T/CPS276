<?php

class Directories{
   
   
// Processes the form
public function addDirectory($directoryName , $fileContent){

    $msg = ''; // Initialize the message variable
     $fileLink = ''; // To store the path of the created file or directory


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    //adds a name if the add button is clicked
    if (isset($_POST['submitButton'])) {
        $directoryName = ($_POST['FolderName']);
        $fileContent = ($_POST['fileContent']);
        $path ='directories/'. $directoryName;
        // Set proper permissions for the directory
        //$directoryName = 'mydirectory';
        //chmod('directories', 0777);

          // Creates the directory
        if(!is_dir($path)) {

          
            mkdir($path, 0777, true);
            $msg = "Directory $directoryName created succesfully";

           // if(!mkdir($path, 077)){
            //    $msg = "Direcotry created"; 
           // }
            // creates a file inside the new directory
            $fileName = $path . '/readme.txt';
            file_put_contents($fileName, $fileContent);
            $fileLink = $fileName;
            } else {
                $msg = "Directory '$directoryName' already exists.";
            }
            
         }
    }  
    return [$msg, $fileLink]; 
    }
}
?>
