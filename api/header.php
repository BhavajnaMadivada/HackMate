<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']); // Replace 'user_id' with your session variable
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Finder</title>
    <link rel="stylesheet" href="header.css"> <!-- Link to your CSS file -->
    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <div class="head">
        <h1>Hack Mate</h1>
    </div>
    <div class="nav_sty">
        
        <!-- Navigation Menu -->
        <nav class="menu">
            <a href="<?= $loggedIn ? 'home.php' : 'login.php'; ?>" class="<?= (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : '' ?>">Home</a>
            <a href="<?= $loggedIn ? 'join.php' : 'login.php'; ?>" class="<?= (basename($_SERVER['PHP_SELF']) == 'join.php') ? 'active' : '' ?>">Join</a>
            <a href="<?= $loggedIn ? 'teams_overview.php' : 'login.php'; ?>" class="<?= (basename($_SERVER['PHP_SELF']) == 'teams_overview.php') ? 'active' : '' ?>">Find Teammates</a>
        </nav>
        
        <!-- Search, Profile, and Notifications Icons -->
        <div class="header-icons">
            <?php if ($loggedIn): ?>
                <!-- Search Icon -->
                <div class="search-icon">
                    <i class="fas fa-search" onclick="toggleSearchMenu()"></i>
                    <div id="searchMenu" class="search-menu" style="display: none;">
                        <ul>
                            <li><a href="search_team.php">Search Team</a></li>
                            <li><a href="search_teammate.php">Search Teammates</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Profile Icon -->
                <div class="profile-icon">
                    <a href="profile.php">
                        <i class="fas fa-user"></i>
                    </a>
                </div>

                <!-- Notifications Icon -->
                <div class="notifications-icon">
                    <a href="notification.php">
                        <i class="fas fa-bell"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Login or Logout Button -->
        <?php if ($loggedIn): ?>
            <button class="login-btn" onclick="window.location.href='logout.php'">Logout</button>
        <?php else: ?>
            <button class="login-btn" onclick="window.location.href='login.php'">Login</button>
        <?php endif; ?>
    </div>
</header>

<!-- JavaScript to toggle the search menu -->
<script>
    function toggleMenu() {
        const menu = document.querySelector('.menu');
        menu.classList.toggle('show');
    }

    function toggleSearchMenu() {
        const menu = document.getElementById('searchMenu');
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    }
</script>
</body>
</html>
