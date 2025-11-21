<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <link rel="stylesheet" href="../../style/Admin-user.css" />
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
            <a href="../../Admin-page.php" class="nav-item active">
                <img src="../../Gambar/Logo Admin gelap/Screenshot 2025-11-11 215452.png" alt="User Icon" class="nav-icon" />
                <span>User List</span>
            </a>
            
            <a href="../../Admin-court.php" class="nav-item">
                <img src="../../Gambar/Logo Admin putih/Screenshot 2025-11-11 212122.png" alt="Court Icon" class="nav-icon" />
                <span>Court</span>
            </a>
            <a href="../../Admin-coach.php" class="nav-item">
                <img src="../../Gambar/Logo Admin putih/Screenshot 2025-11-11 212122.png" alt="Coach Icon" class="nav-icon" />
                <span>Coach</span>
            </a>
            <a href="../../Admin-rate.php" class="nav-item">
                <img src="../../Gambar/Logo Admin putih/Screenshot 2025-11-11 215924.png" alt="Rating Icon" class="nav-icon" />
                <span>Rating</span>
            </a>
        </nav>
    </aside>

<div class="table-container-wrapper">
    <h2 class="section-title">User List</h2>
    
    <div class="table-wrapper">
        <table class="main-table">
            <thead>
                <tr>
                    <th class="column-id">ID</th>
                    <th class="column-name">Name</th>
                    <th class="column-email">Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="column-id">1</td>
                    <td class="column-name">Nicholas Richie</td>
                    <td class="column-email">nicholas@email.com</td>
                </tr>
                <tr>
                    <td class="column-id">2</td>
                    <td class="column-name">Billy</td>
                    <td class="column-email">billy@email.com</td>
                </tr>
                <tr>
                    <td class="column-id">3</td>
                    <td class="column-name">Amos</td>
                    <td class="column-email">amos@email.com</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



