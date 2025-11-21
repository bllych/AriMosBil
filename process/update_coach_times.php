<?php
require_once '../config.php';
requireAdmin();

$coach_id = (int)($_POST['coach_id'] ?? 0);
$times = $_POST['times'] ?? [];
$new_time_slot = sanitize($_POST['new_time_slot'] ?? '');

if ($coach_id > 0) {
    // Update existing time slots
    $stmt = $pdo->prepare("UPDATE coach_times SET is_available = 0 WHERE coach_id = ?");
    $stmt->execute([$coach_id]);

    if (!empty($times)) {
        foreach ($times as $time_id => $value) {
            $stmt = $pdo->prepare("UPDATE coach_times SET is_available = 1 WHERE id = ? AND coach_id = ?");
            $stmt->execute([$time_id, $coach_id]);
        }
    }

    // Add new time slot if provided
    if (!empty($new_time_slot)) {
        $stmt = $pdo->prepare("INSERT INTO coach_times (coach_id, time_slot) VALUES (?, ?)");
        $stmt->execute([$coach_id, $new_time_slot]);
    }
}

redirect('../admin/coaches.php');
?>
