<?php
require_once '../config.php';
requireAdmin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $court_id = (int)($_POST['court_id'] ?? 0);
    $name = sanitize($_POST['name'] ?? '');
    $location = sanitize($_POST['location'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $image_path = sanitize($_POST['image_path'] ?? '');
    $description = sanitize($_POST['description'] ?? '');

    // Validation
    if (empty($court_id) || empty($name) || empty($location) || $price <= 0) {
        $errors[] = 'Court ID, name, location, and valid price are required.';
    }

    // Update court if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE courts SET name = ?, location = ?, price = ?, image_path = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$name, $location, $price, $image_path, $description, $court_id])) {
            redirect('../admin/courts.php');
        } else {
            $errors[] = 'Failed to update court.';
        }
    }
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    redirect('../admin/courts.php');
}
?>
