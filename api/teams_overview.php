<?php
session_start();
include('header.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "hackmate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch the user's teams
$stmt = $conn->prepare("SELECT id, team_name, team_description FROM teams WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$teams = [];
while ($row = $result->fetch_assoc()) {
    $teams[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Teams</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your main CSS file -->
    <style>

header {
    background-color: #1f1f1f;
    padding: 15px 0;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #ffffff;
    border-bottom: 3px solid #4caf50;
}

.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 20px;
    text-align: center;
}

h2 {
    margin-bottom: 30px;
    font-size: 28px;
    color: #4caf50;
}

.team-card {
    background-color: #1e1e1e;
    border-radius: 15px;
    padding: 25px;
    margin: 15px auto;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: #e0e0e0;
    text-align: left;
    width: 80%;
}

.team-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.7);
}

.team-card h3 {
    font-size: 22px;
    margin-bottom: 15px;
    color: #4caf50;
}

.team-card p {
    font-size: 16px;
    margin: 0 0 15px;
    color: #bdbdbd;
}

.team-actions {
    margin-top: 15px;
}

.team-actions a {
    display: inline-block;
    text-decoration: none;
    font-size: 14px;
    color: #ffffff;
    background-color: #4caf50;
    padding: 8px 15px;
    border-radius: 8px;
    transition: background-color 0.3s;
}

.team-actions a:hover {
    background-color: #388e3c;
}

.add-team {
    background-color: #4caf50;
    color: #ffffff;
    font-size: 20px;
    border: 3px solid #4caf50;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 20px auto;
    transition: background-color 0.3s;
}

.add-team:hover {
    background-color: #388e3c;
}

.no-results {
    font-size: 18px;
    color: #9e9e9e;
    margin-top: 20px;
}

@media (max-width: 768px) {
    .team-card {
        width: 90%;
    }
}

@media (max-width: 480px) {
    h2 {
        font-size: 24px;
    }

    .team-card {
        padding: 20px;
    }

    .team-card h3 {
        font-size: 20px;
    }

    .team-card p {
        font-size: 14px;
    }

    .team-actions a {
        font-size: 13px;
        padding: 6px 12px;
    }
}

</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Your Teams</h2>
            <!-- Plus icon for adding new teams -->
            <button class="add-team" onclick="window.location.href='create_team.php'">
                <i class="fas fa-plus-circle"></i>
            </button>
        </div>

        <?php if (count($teams) > 0): ?>
            <!-- List all teams -->
            <?php foreach ($teams as $team): ?>
                <div class="team-card">
                    <h3><?= htmlspecialchars($team['team_name']) ?></h3>
                    <p><?= htmlspecialchars($team['team_description']) ?></p>
                    <div class="team-actions">
                        <!-- Manage members button -->
                        <a href="find_teammates.php?team_id=<?= $team['id'] ?>">Add Members</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You haven't created any teams yet. Click the <i class="fas fa-plus-circle"></i> icon to create one.</p>
        <?php endif; ?>
    </div>
</body>
</html>