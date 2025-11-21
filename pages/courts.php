<?php
require_once '../config.php';

// Fetch all courts
$stmt = $pdo->query("SELECT * FROM courts ORDER BY name");
$courts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courts - Basketball Court Booking</title>
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
        <a href="courts.php"> <u>Courts</u></a>
        <a href="coaches.php">Coaches</a>
        <?php if (isAdmin()): ?>
            <a href="../admin/dashboard.php">Admin</a>
        <?php endif; ?>
    </nav>

    <div class="Lokasi" style="text-align: center; margin: 50px 0;">
        <h2>All Courts</h2>
    </div>

    <div class="container">
        <div class="content">
            <div class="grid">
                <?php foreach ($courts as $court): ?>
                    <div class="card">
                        <a href="../booking.php?court_id=<?= $court['id'] ?>">
                            <img src="../<?= htmlspecialchars($court['image_path']) ?>" alt="<?= htmlspecialchars($court['name']) ?>" />
                        </a>
                        <div class="info">
                            <p><strong><?= htmlspecialchars($court['name']) ?></strong></p>
                            <p><?= htmlspecialchars($court['location']) ?></p>
                            <p>⭐ 4.9</p>
                            <p style="margin-top: 40px"><strong>Rp<?= number_format($court['price'], 0, ',', '.') ?>/sesi</strong></p>
                            <a href="../booking.php?court_id=<?= $court['id'] ?>" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
