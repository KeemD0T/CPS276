<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory to upload files
    $uploadDir = 'pdfs/';
    
    // Uploaded file information
    $fileName = $_FILES['fileUpload']['name'];
    $fileTmpName = $_FILES['fileUpload']['tmp_name'];
    $fileSize = $_FILES['fileUpload']['size'];
    $fileType = $_FILES['fileUpload']['type'];
    $fileMimeType = mime_content_type($fileTmpName);
    
    // Initialize error message
    $message = '';

    // Validate file size and type
    if ($fileType == 'application/pdf' && $fileSize <= 100000) {
        if ($fileMimeType == 'application/pdf') {
            // Creating the file path for the existing file (assuming you have a specific naming convention)
            $serverFileName = 'existing_file.pdf'; // Change this to your file's name
            $serverFilePath = $uploadDir . $serverFileName;

            // Check if the server file exists
            if (file_exists($serverFilePath)) {
                // Connect to MySQL database
                $servername = "localhost";
                $username = "root"; // Change this to your MySQL username
                $password = ""; // Change this to your MySQL password
                $dbname = "your_database_name"; // Change this to your database name

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert file information into the database
                $stmt = $conn->prepare("INSERT INTO UploadedFiles (file_name, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $fileName, $serverFilePath);

                if ($stmt->execute()) {
                    $message = 'The file information has been stored successfully!';
                } else {
                    $message = 'Database error: Could not store file information.';
                }

                $stmt->close();
                $conn->close();
            } else {
                $message = 'The file does not exist on the server.';
            }
        } else {
            $message = 'File is not a valid PDF. Please upload a PDF file.';
        }
    } else {
        if ($fileSize > 100000) {
            $message = 'File size exceeds the limit of 100000 bytes.';
        }
        if ($fileType != 'application/pdf') {
            $message = 'Invalid file type. Only PDF files are allowed.';
        }
    }
}
?>

