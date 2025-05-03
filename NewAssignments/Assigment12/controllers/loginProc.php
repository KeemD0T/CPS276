<?php
require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');

$acknowledgment = "<p></p>";

$formConfig = [
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
        'type' => 'password', // Changed to password type
        'regex' => 'password',
        'label' => '*Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'You must enter your password.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'masterStatus' => [
        'error' => false
    ]
];

$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
        $pdo = new PdoMethods();

        $sql = "SELECT * FROM admin WHERE email = :email";
        $bindings = [
            [':email', $_POST['email'], 'str']
        ];

        $records = $pdo->selectBinded($sql, $bindings);

        if($records === 'error'){
            $acknowledgment = '<p style="color: red">There was an error logging in</p>';
        }
        else {
            if(count($records) != 0){
                if(password_verify($_POST['password'], $records[0]['password'])){
                    // Start session and store user info
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['status'] = $records[0]['status'];
                    $_SESSION['email'] = $records[0]['email'];
                    
                    // Redirect based on status
                    if ($records[0]['status'] === 'staff') {
                        header('Location: index.php?page=addContact');
                    } else {
                        header('Location: index.php?page=welcome');
                    }
                    exit();
                }
                else {
                    $acknowledgment = '<p style="color: red">Invalid email or password</p>';
                }
            }
            else {
                $acknowledgment = '<p style="color: red">Invalid email or password</p>';
            }
        }
    }
}
?>
