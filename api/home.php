<?php include('header.php'); ?>
<link rel="stylesheet" href="home.css">

<h2 class="heading">Collaborate. Create. Conquer</h2>
<p>"Together, we innovate. Together, we build. Together, we succeed."</p>

<div class="container">
    <!-- Card 1: Join into a team -->
    <div class="card card1" onclick="window.location.href='<?= $loggedIn ? 'join.php' : 'login.php'; ?>'">
        <div class="card-image">
            <img src="https://cdn.pixabay.com/photo/2023/03/27/05/08/air-jump-7879749_960_720.png" alt="Join Into a Team" />
        </div>
        <div class="card-name">
            <h2>Join Into a Team</h2>
        </div>
    </div>

    <!-- Card 2: Find teammates -->
    <div class="card card2" onclick="window.location.href='<?= $loggedIn ? 'teams_overview.php' : 'login.php'; ?>'">
        <div class="card-image">
            <img src="https://cdn.pixabay.com/photo/2015/10/31/12/41/team-1015712_640.jpg" alt="Find Teammates" />
        </div>
        <div class="card-name">
            <h2>Find Teammates</h2>
        </div>
    </div>
</div>

<!-- JavaScript to toggle the search menu -->
<script>
    function toggleSearchMenu() {
        const menu = document.getElementById('searchMenu');
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    }
</script>

<!-- Include Font Awesome for the icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
