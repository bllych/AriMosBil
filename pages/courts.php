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
    <div class="header-right">
      <?php if (isLoggedIn()): ?>
        <!-- Logged in user profile -->
        <div class="user-profile">
          <img src="../Gambar/Header Foto/User.png" alt="User Avatar" class="user-avatar" />
          <span class="user-name"><?= htmlspecialchars($_SESSION['name']) ?></span>
          <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
      <?php else: ?>
        <!-- Login and Sign Up buttons -->
        <div class="auth-buttons">
          <a href="../login.php" class="btn-login">Login</a>
          <a href="../signup.php" class="btn-signup">Sign Up</a>
        </div>
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

  <div class="Lokasi">
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
              <p style="margin-top: 20px; margin-bottom:30px;">
                <strong>Rp<?= number_format($court['price'], 0, ',', '.') ?>/sesi</strong></p>
              <a href="../booking.php?court_id=<?= $court['id'] ?>" class="btn btn-primary">Book Now</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-box">
      <div class="contact">
        <h3>Contact Us</h3>
      </div>
      <h3>|</h3>
      <div class="socials">
        <a href="https://www.instagram.com/"><img src="../../Gambar/Asset/Instagram.png" alt="Instagram" /></a>
        <a href="https://x.com/"><img src="../../Gambar/Asset/Twitter.png" alt="Twitter" /></a>
        <a href="https://web.whatsapp.com/"><img src="../../Gambar/Asset/Whatsapp.png" alt="WhatsApp" /></a>
        <a href="https://www.tiktok.com/id-ID/"><img src="../../Gambar/Asset/Tiktok.png" alt="TikTok" /></a>
        <a href="https://mail.google.com/mail/u/0/"><img src="../../Gambar/Asset/email.png" alt="Email" /></a>
        <a href="https://www.youtube.com/watch?v=tL9yDq5hpgI"><img src="../../Gambar/Asset/Phone.png" alt="Phone" /></a>
      </div>
    </div>
  </footer>

  <!-- Section Info/Footer Biru -->
  <div class="all-footer-biru">
    <div class="footer-biru">
      <div class="info-section1">
        <div class="info-box">
          <h3>About Us</h3>
          <p>Our team</p>
          <p style="margin-bottom: 61px">Privacy & Policy</p>
        </div>

        <div class="info-box">
          <h3>Support :</h3>
          <p>Help</p>
          <p>Feedback</p>
        </div>
      </div>
      <div class="info-section2">
        <div class="info-box">
          <h3>Contact Us :</h3>
          <p>+62 813 4609 9722</p>
          <p>@username</p>
          <p style="margin-bottom: 40px">myemail@gmail.com</p>
        </div>
        <div class="info-box">
          <h3>Community :</h3>
          <p>Twitter</p>
          <p>Instagram</p>
        </div>
      </div>
    </div>

    <div class="gambar-info-box">
      <hhh3>
        <h3>Payment methods :</h3>
      </hhh3>
      <div class="fotopayment">
        <div class="payments1">
          <a href="https://gopay.co.id/"><img src="../../Gambar/Asset/QRIS.png" alt="qris"
              style="width: 110px; height: 50px" /></a>
          <a href="https://gopay.co.id/"><img src="../../Gambar/Asset/GOPAY.png" alt="gopay"
              style="width: 150px; height: 45px" /></a>
          <a href="https://gopay.co.id/"><img src="../../Gambar/Asset/MANDIRI.png" alt="mandiri"
              style="width: 153px; height: 50px" /></a>
        </div>

        <div class="payment2">
          <a href="https://gopay.co.id/"><img src="../../Gambar/Asset/SHOPEEPAY.png" alt="shopeepay"
              style="width: 119px; height: 55px" /></a>
          <a href="https://gopay.co.id/"><img src="../../Gambar/Asset/BCA.png" alt="bca"
              style="width: 118px; height: 55px" /></a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>