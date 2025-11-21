<!DOCTYPE html>
<html lang="en">

<head>
  <title>Payment Lapangan</title>
  <link rel="stylesheet" href="../../style/Headfoot.css" />
  <link rel="stylesheet" href="../../style/Payment.css" />
</head>

<body>
  <!-- Header -->
  <header>
    <div class="logo">
      <a href="index.php"><img src="../../Gambar/Header Foto/logo.png" /></a>
    </div>
    <div class="search-bar">
      <img src="../../Gambar/Header Foto/Search.png" alt="Search" />
      <input type="text" placeholder="Search..." />
    </div>
    <div class="lgokanan">
      <a href=""><img src="../../Gambar/Header Foto/Notif.png" alt="" style="margin-right: 35px" /></a>
      <a href="/Account/index.php"><img src="../../Gambar/Header Foto/User.png" alt="" /></a>
    </div>
  </header>
  <hr style="margin-top: 20px" />
  <!-- Navbar -->
  <nav>
    <a href="../../index.php"> <u>Home</u></a>
    <a href="#">Status</a>
    <a href="../../Isi/Coaching.php">Coaching</a>
    <a href="#">Support</a>
  </nav>

  <!-- Main -->
  <main class="payment-container">
    <div class="left-side">
      <div class="info-card">
        <h3>Customer’s information</h3>
        <div class="inputf"><input type="text" placeholder="Full name" /></div>
        <div class="input-row">
          <div class="input-wrapper">
            <div class="flag-section" id="toggleDropdown">
              <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" alt="flag"
                class="flag" />
              <div class="arrow"></div>
            </div>
            <input type="text"  style="font-weight: bold;font: size 14px; border:none; margin-left: 10px;" class="input-number" placeholder="Number" />

            <!-- Dropdown -->
            <div class="dropdown" id="dropdownMenu">
              <input style="width:180px;" type="text" class="searchCountry" placeholder="Cari negara..." />
              <ul id="countryList">
                <li>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" width="20" />
                  Indonesia (+62)
                </li>
                <li>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg"
                    width="20" />
                  United States (+1)
                </li>
                <li>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Flag_of_France.svg" width="20" />
                  France (+33)
                </li>
                <li>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Flag_of_India.svg" width="20" />
                  India (+91)
                </li>
                <li>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Brazil.svg" width="20" />
                  Brazil (+55)
                </li>
              </ul>
            </div>
          </div>

          <div class="input-field">
            <input type="email" placeholder="Email" />
          </div>

        </div>
      </div>

      <div class="info-card">
        <h3>Payment Methods</h3>
        <label class="pay-option">
          <img src="../../Gambar/foto footer/bayar 3.png" style="height: 27px; width: 91px;" alt="Mandiri" />
          <span>Free</span>
          <input type="radio" name="payment" />
        </label>

        <label class="pay-option">
          <img src="../../Gambar/foto footer/bayar 1.png" style="height: 27px; width: 91px;" alt="QRIS" />
          <span>Free</span>
          <input type="radio" name="payment" />
        </label>

        <label class="pay-option">
          <img src="../../Gambar/foto footer/bayar 2.png" style="height: 22px; width: 91px;" alt="GoPay" />
          <span>Free</span>
          <input type="radio" name="payment" />
        </label>

        <label class="pay-option">
          <img src="../../Gambar/foto footer/bayar 5.png" style="height: 40px; width: 91px;" alt="BCA" />
          <span>Free</span>
          <input type="radio" name="payment" />
        </label>

        <label class="pay-option">
          <img src="../../Gambar/foto footer/bayar 4.png" style="height: 38px; width: 91px;" alt="ShopeePay" />
          <span>Free</span>
          <input type="radio" name="payment" />
        </label>
      </div>
    </div>

    <!-- Bagian kanan -->
    <div class="right-side">

      <div class="cost-card">
        <h3>Cost details</h3>
        <div class="cost-row">
          <span>Rent fee</span>
          <span>Rp 100.000</span>
        </div>
        <div class="cost-row">
          <span>Transportation fee</span>
          <span>Rp -</span>
        </div>
        <hr />
        <div class="cost-row total">
          <span>Total</span>
          <span>Rp 100.000</span>
        </div>
      </div>

      <div class="set-payment">
        <h3>Set payment</h3>
        <p><b>Pay in Full</b><br />Rp 100.000</p>
      </div>

      <button class="pay-btn">Pay</button>
    </div>
  </main>


  <!-- all footer  -->
  <!-- Footer -->
  <footer>
    <div class="footer-box">
      <div class="contact">
        <h3>Contact Us</h3>
      </div>
      <h3>|</h3>
      <div class="socials">
        <a href="https://www.instagram.com/"><img src="../../Gambar/foto footer/Instagram.png" alt="Instagram" /></a>
        <a href="https://x.com/"><img src="../../Gambar/foto footer/Twitter.png" alt="Twitter" /></a>
        <a href="https://web.whatsapp.com/"><img src="../../Gambar/foto footer/Whatsapp.png" alt="WhatsApp" /></a>
        <a href="https://www.tiktok.com/id-ID/"><img src="../../Gambar/foto footer/Tiktok.png" alt="TikTok" /></a>
        <a href="https://mail.google.com/mail/u/0/"><img src="../../Gambar/foto footer/email.png" alt="Email" /></a>
        <a href="https://www.youtube.com/watch?v=tL9yDq5hpgI"><img src="../../Gambar/foto footer/Phone.png"
            alt="Phone" /></a>
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
          <a href="https://gopay.co.id/"><img src="../../Gambar/foto footer/bayar 1.png" alt="qris"
              style="width: 110px; height: 50px" /></a>
          <a href="https://gopay.co.id/"><img src="../../Gambar/foto footer/bayar 2.png" alt="gopay"
              style="width: 150px; height: 45px" /></a>
          <a href="https://gopay.co.id/"><img src="../../Gambar/foto footer/bayar 3.png" alt="mandiri"
              style="width: 153px; height: 50px" /></a>
        </div>

        <div class="payment2">
          <a href="https://gopay.co.id/"><img src="../../Gambar/foto footer/bayar 4.png" alt="shopeepay"
              style="width: 119px; height: 55px" /></a>
          <a href="https://gopay.co.id/"><img src="../../Gambar/foto footer/bayar 5.png" alt="bca"
              style="width: 118px; height: 55px" /></a>
        </div>
      </div>
    </div>
  </div>

  <script src="../../Isi/Js/Payment.js"></script>

</body>

</html>