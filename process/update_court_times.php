<?php
require_once '../config.php';
requireAdmin();

$court_id = (int)($_POST['court_id'] ?? 0);
$times = $_POST['times'] ?? [];
$new_time_slot = sanitize($_POST['new_time_slot'] ?? '');

if ($court_id > 0) {
    // Update existing time slots
    $stmt = $pdo->prepare("UPDATE court_times SET is_available = 0 WHERE court_id = ?");
    $stmt->execute([$court_id]);

    if (!empty($times)) {
        foreach ($times as $time_id => $value) {
            $stmt = $pdo->prepare("UPDATE court_times SET is_available = 1 WHERE id = ? AND court_id = ?");
            $stmt->execute([$time_id, $court_id]);
        }
    }

    // Add new time slot if provided
    if (!empty($new_time_slot)) {
        $stmt = $pdo->prepare("INSERT INTO court_times (court_id, time_slot) VALUES (?, ?)");
        $stmt->execute([$court_id, $new_time_slot]);
    }
}

redirect('../admin/courts.php');
?>
