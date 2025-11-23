<?php
require_once 'config.php';
requireLogin();

$errors = [];
$success = false;
$court_id = (int)($_GET['court_id'] ?? 0);

// Fetch court details
$stmt = $pdo->prepare("SELECT * FROM courts WHERE id = ?");
$stmt->execute([$court_id]);
$court = $stmt->fetch();

if (!$court) {
    die('Court not found.');
}

// Fetch available coaches
$coaches_stmt = $pdo->query("SELECT * FROM coaches");
$coaches = $coaches_stmt->fetchAll();

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = sanitize($_POST['date'] ?? '');
    $time_slot = sanitize($_POST['time_slot'] ?? '');
    $coach_id = (int)($_POST['coach_id'] ?? 0);

    // Validation
    if (empty($date) || empty($time_slot)) {
        $errors[] = 'Date and time slot are required.';
    }

    $booking_date = new DateTime($date);
    $today = new DateTime();
    if ($booking_date < $today) {
        $errors[] = 'Booking date cannot be in the past.';
    }

    // Check availability
    if (empty($errors)) {
        // Check court availability
        $stmt = $pdo->prepare("
            SELECT id FROM court_times
            WHERE court_id = ? AND time_slot = ? AND is_available = 1
        ");
        $stmt->execute([$court_id, $time_slot]);
        if (!$stmt->fetch()) {
            $errors[] = 'Selected time slot is not available for this court.';
        }

        // Check coach availability if selected
        if ($coach_id > 0) {
            $stmt = $pdo->prepare("
                SELECT id FROM coach_times
                WHERE coach_id = ? AND time_slot = ? AND is_available = 1
            ");
            $stmt->execute([$coach_id, $time_slot]);
            if (!$stmt->fetch()) {
                $errors[] = 'Selected time slot is not available for this coach.';
            }
        }

        // Check for existing bookings
        $stmt = $pdo->prepare("
            SELECT id FROM bookings
            WHERE court_id = ? AND date = ? AND time_slot = ? AND status IN ('pending', 'confirmed')
        ");
        $stmt->execute([$court_id, $date, $time_slot]);
        if ($stmt->fetch()) {
            $errors[] = 'This time slot is already booked.';
        }

        if ($coach_id > 0) {
            $stmt = $pdo->prepare("
                SELECT id FROM bookings
                WHERE coach_id = ? AND date = ? AND time_slot = ? AND status IN ('pending', 'confirmed')
            ");
            $stmt->execute([$coach_id, $date, $time_slot]);
            if ($stmt->fetch()) {
                $errors[] = 'This coach is already booked for this time slot.';
            }
        }
    }

    // Insert booking if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO bookings (user_id, court_id, coach_id, date, time_slot)
            VALUES (?, ?, ?, ?, ?)
        ");
        if ($stmt->execute([$_SESSION['user_id'], $court_id, $coach_id ?: null, $date, $time_slot])) {
            $success = true;
        } else {
            $errors[] = 'Booking failed. Please try again.';
        }
    }
}

// Fetch available time slots for the court
$time_slots_stmt = $pdo->prepare("SELECT time_slot FROM court_times WHERE court_id = ? AND is_available = 1");
$time_slots_stmt->execute([$court_id]);
$time_slots = $time_slots_stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Court - Basketball Court Booking</title>
    <link rel="stylesheet" href="Home.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="Lokasi" style="margin: 50px 0;font-align:center;">
        <h2>Book Court: <?= htmlspecialchars($court['name']) ?></h2>
    </div>

    <div class="booking-form">
        <?php if ($success): ?>
            <div class="alert alert-success">
                Booking successful!
            </div>
        <?php elseif (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required value="<?= htmlspecialchars($_POST['date'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="time_slot" style="">Time Slot:</label>
                    <select id="time_slot" name="time_slot" required>
                        <option value="">Select time slot</option>
                        <?php foreach ($time_slots as $slot): ?>
                            <option value="<?= $slot ?>" <?= ($_POST['time_slot'] ?? '') === $slot ? 'selected' : '' ?>>
                                <?= $slot ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="coach_id">Coach (Optional):</label>
                <select id="coach_id" name="coach_id">
                    <option value="0">No coach</option>
                    <?php foreach ($coaches as $coach): ?>
                        <option value="<?= $coach['id'] ?>" <?= ((int)($_POST['coach_id'] ?? 0)) === $coach['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($coach['name']) ?> - Rp<?= number_format($coach['price'], 0, ',', '.') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-top: 20px;">
                <strong>Total Cost:</strong>
                <span id="total-cost">Rp<?= number_format($court['price'], 0, ',', '.') ?></span>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Book Now</button>
        </form>
    </div>

    <script>
        // Update total cost when coach is selected
        document.getElementById('coach_id').addEventListener('change', function() {
            const coachSelect = this;
            const selectedOption = coachSelect.options[coachSelect.selectedIndex];
            const coachPrice = selectedOption.value === '0' ? 0 : parseFloat(selectedOption.textContent.match(/Rp([\d,]+)/)[1].replace(/,/g, ''));
            const courtPrice = <?= $court['price'] ?>;
            const total = courtPrice + coachPrice;
            document.getElementById('total-cost').textContent = 'Rp' + total.toLocaleString('id-ID');
        });
    </script>
</body>
</html>
