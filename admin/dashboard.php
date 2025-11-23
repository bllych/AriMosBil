<?php
require_once '../config.php';
requireAdmin();

// Fetch some stats
$user_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$court_count = $pdo->query("SELECT COUNT(*) FROM courts")->fetchColumn();
$coach_count = $pdo->query("SELECT COUNT(*) FROM coaches")->fetchColumn();
$booking_count = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status = 'pending'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Basketball Court Booking</title>
    <link rel="stylesheet" href="../Home.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
        <a href="dashboard.php"> <u>Admin</u></a>
    </nav>

    <div class="Lokasi">
        <h2>Admin Dashboard</h2>
    </div>

    <div class="container">
        <div class="content">
            <h3>Quick Stats</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <div style="border: 2px solid #4682b4; padding: 20px; border-radius: 10px; text-align: center;">
                    <h4>Total Users</h4>
                    <p style="font-size: 24px; color: #002984;"><?= $user_count ?></p>
                </div>
                <div style="border: 2px solid #4682b4; padding: 20px; border-radius: 10px; text-align: center;">
                    <h4>Total Courts</h4>
                    <p style="font-size: 24px; color: #002984;"><?= $court_count ?></p>
                </div>
                <div style="border: 2px solid #4682b4; padding: 20px; border-radius: 10px; text-align: center;">
                    <h4>Total Coaches</h4>
                    <p style="font-size: 24px; color: #002984;"><?= $coach_count ?></p>
                </div>
                <div style="border: 2px solid #4682b4; padding: 20px; border-radius: 10px; text-align: center;">
                    <h4>Pending Bookings</h4>
                    <p style="font-size: 24px; color: #002984;"><?= $booking_count ?></p>
                </div>
            </div>

            <h3>Management</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <a href="users.php" class="btn btn-primary" style="text-align: center; padding: 20px; text-decoration: none;">Manage Users</a>
                <a href="courts.php" class="btn btn-primary" style="text-align: center; padding: 20px; text-decoration: none;">Manage Courts</a>
                <a href="coaches.php" class="btn btn-primary" style="text-align: center; padding: 20px; text-decoration: none;">Manage Coaches</a>
                <a href="bookings.php" class="btn btn-primary" style="text-align: center; padding: 20px; text-decoration: none;">Manage Bookings</a>
            </div>
        </div>
    </div>
</body>
</html>
