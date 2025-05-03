<?php
require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');

$acknowledgment = "<p></p>";

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => 'You must enter a valid first name',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
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
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => '*Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'password' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => '*Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'Password must be at least 8 characters long',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'status' => [
        'type' => 'select',
        'label' => '*Status',
        'name' => 'status',
        'id' => 'status',
        'errorMsg' => 'You must select a status.',
        'error' => '',
        'selected' => '0',
        'required' => true,
        'options' => [
            '0' => 'Select Status',
            'admin' => 'Administrator',
            'staff' => 'Staff'
        ]
    ],
    'masterStatus' => [
        'error' => false
    ]
];

// Initialize StickyForm instance
$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
        $pdo = new PdoMethods();

        // Check for duplicate email
        $checkSql = "SELECT email FROM admin WHERE email = :email";
        $checkBindings = [
            [':email', $_POST['email'], 'str']
        ];
        
        $records = $pdo->selectBinded($checkSql, $checkBindings);
        
        if($records === 'error') {
            $acknowledgment = '<p style="color: red">There was an error checking for duplicate email</p>';
        }
        else if(count($records) > 0) {
            // Email already exists
            $acknowledgment = '<p style="color: red">This email address is already registered. Please use a different email.</p>';
            // Keep the form sticky
            $formConfig['email']['value'] = $_POST['email'];
        }
        else {
            // Email is unique, proceed with insert
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO admin (firstName, lastName, email, password, status) 
                    VALUES (:fname, :lname, :email, :password, :status)";

            $bindings = [
                [':fname', $_POST['first_name'], 'str'],
                [':lname', $_POST['last_name'], 'str'],
                [':email', $_POST['email'], 'str'],
                [':password', $hashedPassword, 'str'],
                [':status', $_POST['status'], 'str']
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if($result === 'error') {
                $acknowledgment = '<p style="color: red">There was an error adding the admin</p>';
            }
            else {
                $acknowledgment = '<p style="color: green">Admin added successfully</p>';
                // Clear the form after successful submission
                $formConfig['first_name']['value'] = '';
                $formConfig['last_name']['value'] = '';
                $formConfig['email']['value'] = '';
                $formConfig['password']['value'] = '';
                $formConfig['status']['selected'] = '0';
            }
        }
    }
}
?>
