<?php
//defines a class
class Directories {
    //defines a public method and takes two parameter dirname and filecContent
    public function createDirectoryAndFile($dirName, $fileContent) {
       //sets a the base diectory path
        $baseDir = 'directories/';
        //This line concatenates the base directory with the directory name provided in $dirName to create the full path.
        $fullPath = $baseDir . $dirName;
        //his line checks if the directory specified by $fullPath does not already exist.
        if (!file_exists($fullPath)) {
            //If the directory does not exist, this line creates it with permissions set to 0777 (read, write, and execute for all users). The true parameter allows the creation of nested directories
            mkdir($fullPath, 0777, true);
            //This line creates a file named readme.txt in the newly created directory and writes the content provided in $fileContent to it.
            file_put_contents($fullPath . '/readme.txt', $fileContent);
            return $fullPath . '/readme.txt';
        } else {
            return false;
        }
        


        }

    }

?>
