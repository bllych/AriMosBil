<?php
require_once '../config.php';
requireAdmin();

// Fetch all bookings with related data
$stmt = $pdo->prepare("
    SELECT b.*, u.name as user_name, c.name as court_name, co.name as coach_name
    FROM bookings b
    LEFT JOIN users u ON b.user_id = u.id
    LEFT JOIN courts c ON b.court_id = c.id
    LEFT JOIN coaches co ON b.coach_id = co.id
    ORDER BY b.created_at DESC
");
$stmt->execute();
$bookings = $stmt->fetchAll();

// Handle errors from process pages
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Admin</title>
    <link rel="stylesheet" href="../Home.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/admin-modals.js" defer></script>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="../index.php"><img src="../Gambar/Header Foto/logo.png" alt="Logo" /></a>
        </div>
        <div class="search-bar">
            <img src="../Gambar/Header Foto/Search.png" alt="Search" />
            <input type="text" placeholder="Search..." />
        </div>
        <div class="lgokanan">
            <a href="../logout.php"><img src="../Gambar/Header Foto/User.png" alt="Logout" /></a>
        </div>
    </header>
    <hr style="margin-top: 20px" />
    <!-- Navbar -->
    <nav>
        <a href="../index.php">Home</a>
        <a href="../pages/courts.php">Courts</a>
        <a href="../pages/coaches.php">Coaches</a>
        <a href="dashboard.php">Admin</a>
    </nav>

    <div class="Lokasi" style="text-align: center; margin: 50px 0;">
        <h2>Manage Bookings</h2>
    </div>

    <div class="container">
        <div class="content">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <button class="btn btn-primary" onclick="openAddModal()">Add New Booking</button>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Court</th>
                        <th>Coach</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= $booking['id'] ?></td>
                            <td><?= htmlspecialchars($booking['user_name']) ?></td>
                            <td><?= htmlspecialchars($booking['court_name']) ?></td>
                            <td><?= $booking['coach_name'] ? htmlspecialchars($booking['coach_name']) : 'None' ?></td>
                            <td><?= $booking['date'] ?></td>
                            <td><?= $booking['time_slot'] ?></td>
                            <td>
                                <span style="color: <?= $booking['status'] === 'confirmed' ? 'green' : ($booking['status'] === 'cancelled' ? 'red' : 'orange') ?>">
                                    <?= ucfirst($booking['status']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($booking['status'] === 'pending'): ?>
                                    <form method="POST" action="../process/update_booking_status.php" style="display: inline;">
                                        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-secondary">Confirm</button>
                                    </form>
                                    <form method="POST" action="../process/update_booking_status.php" style="display: inline;">
                                        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Booking Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('addModal')">&times;</span>
            <h3>Add New Booking</h3>
            <form method="POST" action="../process/add_booking.php">
                <div class="form-group">
                    <label for="user_id">User:</label>
                    <select id="user_id" name="user_id" required>
                        <option value="">Select user</option>
                        <?php
                        $users = $pdo->query("SELECT id, name FROM users ORDER BY name")->fetchAll();
                        foreach ($users as $user):
                        ?>
                            <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="court_id">Court:</label>
                    <select id="court_id" name="court_id" required>
                        <option value="">Select court</option>
                        <?php
                        $courts = $pdo->query("SELECT id, name FROM courts ORDER BY name")->fetchAll();
                        foreach ($courts as $court):
                        ?>
                            <option value="<?= $court['id'] ?>"><?= htmlspecialchars($court['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="coach_id">Coach (Optional):</label>
                    <select id="coach_id" name="coach_id">
                        <option value="0">No coach</option>
                        <?php
                        $coaches = $pdo->query("SELECT id, name FROM coaches ORDER BY name")->fetchAll();
                        foreach ($coaches as $coach):
                        ?>
                            <option value="<?= $coach['id'] ?>"><?= htmlspecialchars($coach['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time_slot">Time Slot:</label>
                    <input type="text" id="time_slot" name="time_slot" placeholder="e.g. 09:00-10:00" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Booking</button>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>
