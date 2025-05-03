<?php
require_once('includes/security.php');
require_once('includes/navigation.php');

// Start session
Security::startSession();

// Get the page parameter or default to login
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// Define valid pages
$validPages = [
    'login',
    'welcome',
    'addContact',
    'deleteContacts',
    'addAdmin',
    'deleteAdmins'
];

// Check if the requested page is valid
if (!in_array($page, $validPages)) {
    header('Location: index.php?page=login');
    exit();
}

// Check access and redirect if unauthorized
Security::redirectUnauthorized($page);

$path = '';
switch($page) {
    case 'login':
        require_once('views/loginForm.php');
        $path = init();
        break;
        
    case 'welcome':
        require_once('views/welcome.php');
        $path = init();
        break;
        
    case 'addContact':
        require_once('views/addContactView.php');
        $path = init();
        break;
        
    case 'deleteContacts':
        require_once('views/deleteContactView.php');
        $path = init();
        break;
        
    case 'addAdmin':
        require_once('views/addAdminForm.php');
        $path = init();
        break;
        
    case 'deleteAdmins':
        require_once('views/deleteAdminTable.php');
        $path = init();
        break;
}
?>