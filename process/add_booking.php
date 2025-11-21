<?php
require_once '../config.php';
requireAdmin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = (int)($_POST['user_id'] ?? 0);
    $court_id = (int)($_POST['court_id'] ?? 0);
    $coach_id = (int)($_POST['coach_id'] ?? 0);
    $date = sanitize($_POST['date'] ?? '');
    $time_slot = sanitize($_POST['time_slot'] ?? '');
    $status = sanitize($_POST['status'] ?? 'pending');

    // Validation
    if (empty($user_id) || empty($court_id) || empty($date) || empty($time_slot)) {
        $errors[] = 'User, court, date, and time slot are required.';
    }

    if (!in_array($status, ['pending', 'confirmed', 'cancelled'])) {
        $errors[] = 'Invalid status.';
    }

    // Check if user, court, and coach exist
    $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    if (!$stmt->fetch()) {
        $errors[] = 'User not found.';
    }

    $stmt = $pdo->prepare("SELECT id FROM courts WHERE id = ?");
    $stmt->execute([$court_id]);
    if (!$stmt->fetch()) {
        $errors[] = 'Court not found.';
    }

    if ($coach_id > 0) {
        $stmt = $pdo->prepare("SELECT id FROM coaches WHERE id = ?");
        $stmt->execute([$coach_id]);
        if (!$stmt->fetch()) {
            $errors[] = 'Coach not found.';
        }
    }

    // Check for conflicts
    if (empty($errors)) {
        $stmt = $pdo->prepare("
            SELECT id FROM bookings
            WHERE court_id = ? AND date = ? AND time_slot = ? AND status IN ('pending', 'confirmed')
        ");
        $stmt->execute([$court_id, $date, $time_slot]);
        if ($stmt->fetch()) {
            $errors[] = 'Court is already booked for this time slot.';
        }

        if ($coach_id > 0) {
            $stmt = $pdo->prepare("
                SELECT id FROM bookings
                WHERE coach_id = ? AND date = ? AND time_slot = ? AND status IN ('pending', 'confirmed')
            ");
            $stmt->execute([$coach_id, $date, $time_slot]);
            if ($stmt->fetch()) {
                $errors[] = 'Coach is already booked for this time slot.';
            }
        }
    }

    // Insert booking if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO bookings (user_id, court_id, coach_id, date, time_slot, status)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        if ($stmt->execute([$user_id, $court_id, $coach_id ?: null, $date, $time_slot, $status])) {
            redirect('../admin/bookings.php');
        } else {
            $errors[] = 'Failed to add booking.';
        }
    }
}

// If there are errors, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    redirect('../admin/bookings.php');
}
?>
