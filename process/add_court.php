<?php
require_once '../config.php';
requireAdmin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $location = sanitize($_POST['location'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $image_path = sanitize($_POST['image_path'] ?? '');
    $description = sanitize($_POST['description'] ?? '');

    // Validation
    if (empty($name) || empty($location) || $price <= 0) {
        $errors[] = 'Name, location, and valid price are required.';
    }

    // Insert court if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO courts (name, location, price, image_path, description) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $location, $price, $image_path, $description])) {
            redirect('../admin/courts.php');
        } else {
            $errors[] = 'Failed to add court.';
        }
    }
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    redirect('../admin/courts.php');
}
?>
