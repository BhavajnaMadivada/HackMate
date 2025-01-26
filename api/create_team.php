<?php
// Start session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '1234', 'hackmate');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming the user_id is stored in the session
    $user_id = $_SESSION['user_id']; // Make sure this is set during user login

    // Sanitize input data
    $hackathon_name = $_POST['hackathon_name'];
    $team_name = $_POST['team_name'];
    $team_description = $_POST['team_description'];
    $team_skills = $_POST['team_skills'];
    $country = $_POST['country'];
    $contact_email = $_POST['contact_email'];
    $github_url = $_POST['github_url'];
    $twitter_url = $_POST['twitter_url'];

    // Prepare the SQL statement with user_id
    $stmt = $conn->prepare("INSERT INTO teams (hackathon_name, team_name, team_description, team_skills, country, contact_email, github_url, twitter_url, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $hackathon_name, $team_name, $team_description, $team_skills, $country, $contact_email, $github_url, $twitter_url, $user_id);

    if ($stmt->execute()) {
        // Redirect to find_teamates.php on successful registration
        header("Location: find_teammates.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a HackBud</title>
    <style>
        body {
            background-color: #0d1117;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            background-color: #161b22;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #21262d;
            color: white;
        }
        .form-group textarea {
            resize: none;
            height: 80px;
        }
        .submit-button {
            width: 100%;
            padding: 10px;
            background-color: #6c63ff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #584bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Find a HackBud</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="hackathon_name">Hackathon Name</label>
                <input type="text" id="hackathon_name" name="hackathon_name" required>
            </div>
            <div class="form-group">
                <label for="team_name">Team Name</label>
                <input type="text" id="team_name" name="team_name" required>
            </div>
            <div class="form-group">
                <label for="team_description">Team Description</label>
                <textarea id="team_description" name="team_description" maxlength="100"></textarea>
            </div>
            <div class="form-group">
                <label for="team_skills">Team Skills</label>
                <input type="text" id="team_skills" name="team_skills">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="contact_email">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" required>
            </div>
            <div class="form-group">
                <label for="github_url">GitHub URL</label>
                <input type="url" id="github_url" name="github_url">
            </div>
            <div class="form-group">
                <label for="twitter_url">Twitter URL (optional)</label>
                <input type="url" id="twitter_url" name="twitter_url">
            </div>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
</body>
</html>
