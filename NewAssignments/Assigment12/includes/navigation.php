<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getNavigation() {
    // If not logged in, only show login
    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
        return <<<HTML
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php?page=login">Login</a>
                </div>
            </div>
        </nav>
        HTML;
    }

    // If logged in as staff, show limited menu
    if ($_SESSION['status'] === 'staff') {
        return <<<HTML
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
                    <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact</a>
                    <a class="nav-link" href="index.php?page=logout">Logout</a>
                </div>
            </div>
        </nav>
        HTML;
    }

    // If logged in as admin, show full menu
    return <<<HTML
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <div class="navbar-nav">
                <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
                <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact</a>
                <a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>
                <a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin</a>
                <a class="nav-link" href="index.php?page=logout">Logout</a>
            </div>
        </div>
    </nav>
    HTML;
}
?>