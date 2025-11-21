<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <link rel="stylesheet" href="../../style/Admin-rate.css" />
  <link rel="stylesheet" href="../../style/Headfoot.css" />
</head>
<!-- Header -->
<header>
  <div class="logo">
    <a href="../../index.php"><img src="../../Gambar/Header Foto/logo.png" /></a>
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

<div class="content-wrapper">
    
    <aside class="sidebar">
        <div class="sidebar-header">    
                <img src="../../Gambar/Header Foto/Logo.png" alt="Court Mate Logo" class="sidebar-logo" />  
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <a href="../../Admin-page.php" class="nav-item">
                <img src="../../Gambar/Logo Admin putih/Screenshot 2025-11-11 220212.png" alt="User Icon" class="nav-icon" />
                <span>User List</span>
            </a>
            
            <a href="../../Admin-court.php" class="nav-item">
                <img src="../../Gambar/Logo Admin putih/Screenshot 2025-11-11 211514.png" alt="Court Icon" class="nav-icon" />
                <span>Court</span>
            </a>
            <a href="../../Admin-coach.php" class="nav-item">
                <img src="../../Gambar/Logo Admin putih/Screenshot 2025-11-11 212122.png" alt="Coach Icon" class="nav-icon" />
                <span>Coach</span>
            </a>
            <a href="../../Admin-rate.php" class="nav-item active">
                <img src="../../Gambar/Logo Admin gelap/Screenshot 2025-11-11 220330.png" alt="Rating Icon" class="nav-icon" />
                <span>Rating</span>
            </a>
        </nav>
    </aside>

    <style>
    :root {
        --primary-blue-dark: #1C34AC;
        --content-max-width: 900px;
        --main-bg: #F9FAFB;
    }
</style>

<div class="table-container-wrapper">
    <h2 class="section-title">Rating List</h2>
    
    <div class="table-wrapper">
        <table class="main-table">
            <thead>
                <tr>
                    <th class="column-id">ID</th>
                    <th class="column-user">User</th>
                    <th class="column-rating-value">Rating</th>
                    <th class="column-date">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="column-id">1</td>
                    <td class="column-user">Nicholas Richie</td>
                    <td class="column-rating-value rating-5star">★★★★★</td>
                    <td class="column-date">2025-11-01</td>
                </tr>
                <tr>
                    <td class="column-id">2</td>
                    <td class="column-user">Billy</td>
                    <td class="column-rating-value rating-4star">★★★★☆</td>
                    <td class="column-date">2025-11-05</td>
                </tr>
                <tr>
                    <td class="column-id">3</td>
                    <td class="column-user">Amos</td>
                    <td class="column-rating-value rating-5star">★★★★★</td>
                    <td class="column-date">2025-11-10</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>