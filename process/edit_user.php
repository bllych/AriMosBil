<?php
require_once '../config.php';
requireAdmin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = (int)($_POST['user_id'] ?? 0);
    $name = sanitize($_POST['name'] ?? '');
    $username = sanitize($_POST['username'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $role = sanitize($_POST['role'] ?? 'user');

    // Validation
    if (empty($user_id) || empty($name) || empty($username) || empty($email)) {
        $errors[] = 'All fields are required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (!in_array($role, ['user', 'admin'])) {
        $errors[] = 'Invalid role.';
    }

    // Check if username or email already exists (excluding current user)
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
        $stmt->execute([$username, $email, $user_id]);
        if ($stmt->fetch()) {
            $errors[] = 'Username or email already exists.';
        }
    }

    // Update user if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, username = ?, email = ?, role = ? WHERE id = ?");
        if ($stmt->execute([$name, $username, $email, $role, $user_id])) {
            redirect('../admin/users.php');
        } else {
            $errors[] = 'Failed to update user.';
        }
    }
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    redirect('../admin/users.php');
}
?>
