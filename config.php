<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'basketball_booking');
define('DB_USER', 'root'); // Change this to your database username
define('DB_PASS', ''); // Change this to your database password

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Helper functions
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function isAdmin()
{
    return isLoggedIn() && $_SESSION['role'] === 'admin';
}

function requireLogin($redirect_to = 'login.php')
{
    if (!isLoggedIn()) {
        header('Location: ' . $redirect_to);
        exit;
    }
}

function requireAdmin()
{
    if (!isAdmin()) {
        header('Location: index.php');
        exit;
    }
}

function sanitize($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($url)
{
    header("Location: $url");
    exit;
}
?>