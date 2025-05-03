<?php
class Security {
    // Define allowed pages for each user role
    private static $allowedPages = [
        'staff' => ['addContact', 'deleteContacts', 'logout'],
        'admin' => ['addContact', 'deleteContacts', 'addAdmin', 'deleteAdmins', 'logout']
    ];

    // Start session if not already started
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Check if user is logged in
    public static function isLoggedIn() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    // Get current user's status (staff or admin)
    public static function getUserStatus() {
        return $_SESSION['status'] ?? null;
    }

    // Check if user has access to a specific page
    public static function hasAccess($page) {
        // Allow access to login and welcome pages without login
        if ($page === 'login' || $page === 'welcome') {
            return true;
        }

        if (!self::isLoggedIn()) {
            return false;
        }

        $status = self::getUserStatus();
        return isset(self::$allowedPages[$status]) && 
               in_array($page, self::$allowedPages[$status]);
    }

    // Redirect user based on their status
    public static function redirectUnauthorized($page) {
        // Allow access to login and welcome pages without login
        if ($page === 'login' || $page === 'welcome') {
            return;
        }

        if (!self::isLoggedIn()) {
            header('Location: index.php?page=login');
            exit();
        }

        if (!self::hasAccess($page)) {
            $status = self::getUserStatus();
            if ($status === 'staff') {
                header('Location: index.php?page=addContact');
            } else {
                header('Location: index.php?page=addAdmin');
            }
            exit();
        }
    }

    // Sanitize input data
    public static function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Generate CSRF token
    public static function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // Verify CSRF token
    public static function verifyCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && 
               hash_equals($_SESSION['csrf_token'], $token);
    }
}
?>
