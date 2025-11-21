<?php
require_once '../config.php';
requireAdmin();

$user_id = (int)($_POST['user_id'] ?? 0);

if ($user_id > 0 && $user_id !== $_SESSION['user_id']) { // Prevent self-deletion
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
}

redirect('../admin/users.php');
?>
