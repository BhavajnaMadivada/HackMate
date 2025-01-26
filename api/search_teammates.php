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

// Get the logged-in user's ID
$loggedInUserId = $_SESSION['user_id'];

// Handle search query
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

$response = [];

if ($searchQuery !== '') {
    // Exclude teams created by the logged-in user
    $stmt = $conn->prepare("
        SELECT name, skills, role 
        FROM users 
        WHERE (name LIKE ? OR skills LIKE ?) 
        AND id != ?
    ");
    $likeQuery = "%" . $searchQuery . "%";
    $stmt->bind_param("ssi", $likeQuery, $likeQuery, $loggedInUserId);
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
