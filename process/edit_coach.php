<?php
require_once '../config.php';
requireAdmin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coach_id = (int)($_POST['coach_id'] ?? 0);
    $name = sanitize($_POST['name'] ?? '');
    $specialty = sanitize($_POST['specialty'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $image_path = sanitize($_POST['image_path'] ?? '');
    $description = sanitize($_POST['description'] ?? '');

    // Validation
    if (empty($coach_id) || empty($name) || $price <= 0) {
        $errors[] = 'Coach ID, name, and valid price are required.';
    }

    // Update coach if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE coaches SET name = ?, specialty = ?, price = ?, image_path = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$name, $specialty, $price, $image_path, $description, $coach_id])) {
            redirect('../admin/coaches.php');
        } else {
            $errors[] = 'Failed to update coach.';
        }
    }
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    redirect('../admin/coaches.php');
}
?>
