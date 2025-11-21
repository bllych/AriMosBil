<?php
require_once '../config.php';
requireAdmin();

$booking_id = (int)($_POST['booking_id'] ?? 0);
$status = sanitize($_POST['status'] ?? '');

if ($booking_id > 0 && in_array($status, ['pending', 'confirmed', 'cancelled'])) {
    $stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
    $stmt->execute([$status, $booking_id]);
}

redirect('../admin/bookings.php');
?>
