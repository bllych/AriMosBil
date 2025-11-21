<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <link rel="stylesheet" href="../../style/Admin-court.css" />
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
            <a href="../../Admin-coach.php" class="nav-item active">
                <img src="../../Gambar/Logo Admin gelap/Screenshot 2025-11-11 220257.png" alt="Coach Icon" class="nav-icon" />
                <span>Coach</span>
            </a>
            <a href="../../Admin-rate.php" class="nav-item">
                <img src="../../Gambar/Logo Admin putih/Screenshot 2025-11-11 215924.png" alt="Rating Icon" class="nav-icon" />
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

<div class="stats-container">
    
    <div class="stat-box">
        <div class="stat-content-inner">
            <img src="path/to/user-icon.png" alt="User Icon" class="stat-icon" />
            <div class="text-group">
                <span class="stat-label">Total Users</span>
                <span class="stat-number">129</span>
            </div>
        </div>
    </div>
    
    <div class="stat-box">
        <div class="stat-content-inner">
            <img src="path/to/court-icon-2.png" alt="Court Icon" class="stat-icon" />
            <div class="text-group">
                <span class="stat-label">Total Courts</span>
                <span class="stat-number">25</span>
            </div>
        </div>
    </div>
    
    <div class="stat-box">
        <div class="stat-content-inner">
            <img src="path/to/coach-icon-2.png" alt="Coach Icon" class="stat-icon" />
            <div class="text-group">
                <span class="stat-label">Total Coach</span>
                <span class="stat-number">10</span>
            </div>
        </div>
    </div>
    
</div>

<div class="table-container-wrapper">
    <h2 class="section-title">Coach List</h2>
    
    <div class="table-wrapper">
        <table class="main-table">
            <thead>
                <tr>
                    <th class="column-id">ID</th>
                    <th class="column-name">Name</th>
                    <th class="column-location">Location</th>
                    <th class="column-status">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="column-id">1</td>
                    <td class="column-name">MOTAMOTAMOT</td>
                    <td class="column-location">Serdam</td>
                    <td class="column-status status-available">Available</td>
                </tr>
                <tr>
                    <td class="column-id">2</td>
                    <td class="column-name">SuperSil</td>
                    <td class="column-location">Karya Baru</td>
                    <td class="column-status status-onduty">On Duty</td>
                </tr>
                <tr>
                    <td class="column-id">3</td>
                    <td class="column-name">Achai Black</td>
                    <td class="column-location">Purnama</td>
                    <td class="column-status status-notavailable">Not Available</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>