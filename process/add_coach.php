<?php
require_once '../config.php';
requireAdmin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $specialty = sanitize($_POST['specialty'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $image_path = sanitize($_POST['image_path'] ?? '');
    $description = sanitize($_POST['description'] ?? '');

    // Validation
    if (empty($name) || $price <= 0) {
        $errors[] = 'Name and valid price are required.';
    }

    // Insert coach if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO coaches (name, specialty, price, image_path, description) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $specialty, $price, $image_path, $description])) {
            redirect('../admin/coaches.php');
        } else {
            $errors[] = 'Failed to add coach.';
        }
    }
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    redirect('../admin/coaches.php');
}
?>
