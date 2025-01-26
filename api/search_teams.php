<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "hackmate";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle search query
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

$response = [];

if ($searchQuery !== '') {
    $stmt = $conn->prepare("SELECT team_name, team_description FROM teams WHERE team_name LIKE ? OR team_skills LIKE ?");
    $likeQuery = "%" . $searchQuery . "%";
    $stmt->bind_param("ss", $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    $stmt->close();
}

$conn->close();

// Return results as JSON
header('Content-Type: application/json');
echo json_encode($response);
