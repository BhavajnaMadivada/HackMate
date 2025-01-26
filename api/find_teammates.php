<?php 
session_start();
include('header.php');

// MySQL connection details
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

// Check if the user has registered a team
$stmt = $conn->prepare("SELECT id FROM teams WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo "<script>alert('Please register a team before searching for teammates.'); window.location.href = 'register_team.php';</script>";
    exit;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Teammates</title>
    <style>

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffffff;
            text-align:center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            text-align: left;
            color: #d1d5db;
        }

        select, input, button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            outline: none;
            background-color:rgb(116, 142, 179);
            color: white;
            transition: all 0.3s;
        }

        select:focus, input:focus {
            background-color:rgb(242, 242, 242);
            box-shadow: 0 0 8px #6c63ff;
        }

        button {
            background-color: #6c63ff;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            background-color: #4b4fff;
        }

        button:active {
            transform: scale(0.97);
        }
    </style>
</head>
<body >
    <div id="members">
        <h2>Find Teammates</h2>
        <form id="searchForm" method="POST" action="search_results_teammates.php">
            <label for="roleSearch">Select Role</label>
            <select id="roleSearch" name="roleSearch" required>
                <option value="" disabled selected>Select Role</option>
                <option value="Developer">Developer</option>
                <option value="Designer">Designer</option>
                <option value="Business">Business Strategist</option>
                <option value="Other">Other</option>
            </select>

            <label for="skillSearch">Enter Desired Skills</label>
            <input type="text" id="skillSearch" name="skillSearch" placeholder="Enter skills (e.g., React, Figma)" required />

            <button type="submit">Search</button>
        </form>
    </div>
</body>
</html>
