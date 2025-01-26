<?php
session_start();
include('header.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Database connection
$host = 'localhost';
$dbname = 'hackmate';
$username = 'root';
$password = '1234';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}

// Fetch teams created by the user
$teamQuery = "SELECT * FROM teams WHERE user_id = :user_id";
$teamStmt = $pdo->prepare($teamQuery);
$teamStmt->execute(['user_id' => $user_id]);
$teams = $teamStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f3f4f6;
            color: #333;
        } */

        .profile-container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: black;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .profile-header p {
            margin: 5px 0;
            color: #555;
        }

        .profile-details {
            margin-top: 20px;
        }

        .profile-details .detail {
            margin-bottom: 10px;
        }

        .profile-details .detail span {
            font-weight: bold;
        }

        .teams-container {
            margin-top: 30px;
        }

        .teams-container h2 {
            font-size: 24px;
            color: #333;
        }

        .team-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .team-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: calc(33.333% - 20px); /* Three cards per row */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .team-card h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #007BFF;
        }

        .team-card p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .logout {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            background: #f44336;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .logout:hover {
            background: #d32f2f;
        }

        @media (max-width: 768px) {
            .team-card {
                width: calc(50% - 20px); /* Two cards per row on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .team-card {
                width: 100%; /* One card per row on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
            <p>Your Profile Information</p>
        </div>

        <div class="profile-details">
            <div class="detail">
                <span>Name:</span> <?= htmlspecialchars($user['name']) ?>
            </div>
            <div class="detail">
                <span>Email:</span> <?= htmlspecialchars($user['email']) ?>
            </div>
            <div class="detail">
                <span>Skills:</span> <?= htmlspecialchars($user['skills']) ?>
            </div>
            <div class="detail">
                <span>Role:</span> <?= htmlspecialchars($user['role']) ?>
            </div>
        </div>

        <!-- Teams Created by User -->
        <div class="teams-container">
            <h2>Teams Created by You</h2>
            <?php if (count($teams) > 0): ?>
                <div class="team-cards">
                    <?php foreach ($teams as $team): ?>
                        <div class="team-card">
                            <h3><?= htmlspecialchars($team['team_name']) ?></h3>
                            <p><strong>Description:</strong> <?= htmlspecialchars($team['team_description']) ?></p>
                            <p><strong>Team Skills:</strong> <?= htmlspecialchars($team['team_skills']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>You haven't created any teams yet.</p>
            <?php endif; ?>
        </div>

        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>

