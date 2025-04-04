<?php
require_once('classes/StickyForm.php');
require_once('classes/Db_conn.php');

// Initialize database connection
$db = new Db_conn();
$conn = $db->dbOpen();

// Flag to track if form was submitted successfully
$showRecords = false;

// Configuration array defining the structure and validation rules for the form
$formConfig = [
    // First name field configuration
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => 'You must enter a valid first name.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    // Last name field configuration
    'last_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    // Email field configuration
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => false,
        'value' => ''
    ],
    // Password field configuration
    'password' => [
        'type' => 'password',
        'regex' => 'password',
        'label' => '*Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one symbol, and one number.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    // Password confirmation field configuration
    'confirm_password' => [
        'type' => 'password',
        'regex' => 'password',
        'label' => '*Confirm Password',
        'name' => 'confirm_password',
        'id' => 'confirm_password',
        'errorMsg' => 'Passwords do not match.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    // Master status for form validation
    'masterStatus' => [
        'error' => false
    ]
];

// Initialize StickyForm instance for form handling
$stickyForm = new StickyForm();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data and update form configuration
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    
    // Check if passwords match
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $formConfig['confirm_password']['error'] = 'Passwords do not match.';
        $formConfig['masterStatus']['error'] = true;
    }
    // Check if password meets requirements
    else if (strlen($_POST['password']) < 8 || 
             !preg_match('/[A-Z]/', $_POST['password']) || 
             !preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $_POST['password']) || 
             !preg_match('/[0-9]/', $_POST['password'])) {
        $formConfig['password']['error'] = 'Password must be at least 8 characters long and contain at least one uppercase letter, one symbol, and one number.';
        $formConfig['masterStatus']['error'] = true;
    }
    
    // Display validation errors if any
    if ($stickyForm->hasErrors() || $formConfig['masterStatus']['error']) {
        echo '<div class="alert alert-danger">';
        echo '<h5>Please correct the following errors:</h5>';
        echo '<ul>';
        
        // Check each field for errors
        foreach ($formConfig as $key => $element) {
            if ($key !== 'masterStatus' && !empty($element['error'])) {
                echo '<li>' . $element['error'] . '</li>';
            }
        }
        
        echo '</ul>';
        echo '</div>';
    }
    
    // Check if form is valid (no errors)
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
        try {
            // Check if email already exists
            $checkEmailSql = "SELECT COUNT(*) FROM users WHERE email = :email";
            $checkEmailStmt = $conn->prepare($checkEmailSql);
            $checkEmailStmt->bindParam(':email', $_POST['email']);
            $checkEmailStmt->execute();
            $emailExists = $checkEmailStmt->fetchColumn() > 0;
            
            if ($emailExists) {
                $formConfig['email']['error'] = 'This email address is already registered.';
                $formConfig['masterStatus']['error'] = true;
                
                // Display validation errors
                echo '<div class="alert alert-danger">';
                echo '<h5>Please correct the following errors:</h5>';
                echo '<ul>';
                echo '<li>This email address is already registered.</li>';
                echo '</ul>';
                echo '</div>';
            } else {
                // Hash the password
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                
                // Prepare SQL statement
                $sql = "INSERT INTO users (first_name, last_name, email, password) 
                        VALUES (:first_name, :last_name, :email, :password)";
                
                $stmt = $conn->prepare($sql);
                
                // Bind parameters
                $stmt->bindParam(':first_name', $_POST['first_name']);
                $stmt->bindParam(':last_name', $_POST['last_name']);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->bindParam(':password', $hashedPassword);
                
                // Execute the statement
                if ($stmt->execute()) {
                    // Registration successful
                    echo '<div class="alert alert-success">Registration successful! You can now log in.</div>';
                    // Clear the form
                    foreach ($formConfig as $key => &$element) {
                        if (isset($element['value'])) {
                            $element['value'] = '';
                        }
                    }
                    // Set flag to show records
                    $showRecords = true;
                } else {
                    // Registration failed
                    echo '<div class="alert alert-danger">Registration failed. Please try again.</div>';
                }
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo '<div class="alert alert-danger">An error occurred: ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sticky Form Example</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <!-- Main form container -->
    <form method="post" action="">
        <!-- Name fields row -->
        <div class="row">
            <!-- First name field -->
            <div class="col-md-6">
                <?php echo $stickyForm->renderInput($formConfig['first_name'], 'mb-3'); ?>
            </div>

            <!-- Last name field -->
            <div class="col-md-6">
                <?php echo $stickyForm->renderInput($formConfig['last_name'], 'mb-3'); ?>
            </div>
        </div>

        <!-- Contact information row -->
        <div class="row">
            <!-- Email field -->
            <div class="col-md-12">
                <?php echo $stickyForm->renderInput($formConfig['email'], 'mb-3'); ?>
            </div>
        </div>

        <!-- Password fields row -->
        <div class="row">
            <!-- Password field -->
            <div class="col-md-6">
                <?php echo $stickyForm->renderInput($formConfig['password'], 'mb-3'); ?>
            </div>
            <!-- Confirm Password field -->
            <div class="col-md-6">
                <?php echo $stickyForm->renderInput($formConfig['confirm_password'], 'mb-3'); ?>
            </div>
        </div>

        <!-- Submit button -->
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>

    <!-- Display Records Table -->
    <?php
    // Only show records if form was submitted successfully
    if ($showRecords) {
        try {
            // Query to get all records
            $sql = "SELECT first_name, last_name, email FROM users ORDER BY first_name";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($records) > 0) {
                echo '<div class="mt-5">';
                echo '<h3>Registered Users</h3>';
                echo '<table class="table table-striped table-bordered">';
                echo '<thead class="table-dark">';
                echo '<tr>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Email</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                foreach ($records as $record) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($record['first_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['last_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['email']) . '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger mt-5">Error retrieving records: ' . $e->getMessage() . '</div>';
        }
    }
    ?>
</div>

</body>
</html>