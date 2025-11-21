<?php
require_once '../config.php';

// Fetch all coaches
$stmt = $pdo->query("SELECT * FROM coaches ORDER BY name");
$coaches = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coaches - Basketball Court Booking</title>
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
            <?php if (isLoggedIn()): ?>
                <a href="#"><img src="../Gambar/Header Foto/Notif.png" alt="Notifications" style="margin-right: 35px" /></a>
                <a href="../logout.php"><img src="../Gambar/Header Foto/User.png" alt="Logout" /></a>
            <?php else: ?>
                <a href="../login.php"><img src="../Gambar/Header Foto/User.png" alt="Login" /></a>
            <?php endif; ?>
        </div>
    </header>
    <hr style="margin-top: 20px" />
    <!-- Navbar -->
    <nav>
        <a href="../index.php">Home</a>
        <a href="courts.php">Courts</a>
        <a href="coaches.php"> <u>Coaches</u></a>
        <?php if (isAdmin()): ?>
            <a href="../admin/dashboard.php">Admin</a>
        <?php endif; ?>
    </nav>

    <div class="Lokasi" style="text-align: center; margin: 50px 0;">
        <h2>All Coaches</h2>
    </div>

    <div class="container">
        <div class="content">
            <div class="grid">
                <?php foreach ($coaches as $coach): ?>
                    <div class="card">
                        <img src="../<?= htmlspecialchars($coach['image_path']) ?>" alt="<?= htmlspecialchars($coach['name']) ?>" />
                        <div class="info">
                            <p><strong><?= htmlspecialchars($coach['name']) ?></strong></p>
                            <p><em><?= htmlspecialchars($coach['specialty']) ?></em></p>
                            <p>⭐ 4.9</p>
                            <p style="margin-top: 40px"><strong>Rp<?= number_format($coach['price'], 0, ',', '.') ?>/sesi</strong></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
