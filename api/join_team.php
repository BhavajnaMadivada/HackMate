<?php
session_start();
include('header.php'); // Include the header

// Add the CSS link properly in the HTML section
echo '<link rel="stylesheet" href="joinTeam_cards.css">';

// Check if the user is logged in and get the user ID
$user_id = $_SESSION['user_id'] ?? null; // Replace with your actual session key for the user ID
if (!$user_id) {
    // Redirect or show an error if the user is not logged in
    echo "<div class='error-message'>You must be logged in to view teams.</div>";
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "1234", "hackmate");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST for skills search
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['skills'])) {
    $skills = $_POST['skills'] ?? ''; // Get skills input

    // Sanitize user input
    $skills = $conn->real_escape_string($skills);

    // Break skills into an array to allow searching for any skill
    $skillsArray = explode(',', $skills); // Skills separated by commas
    $skillsArray = array_map('trim', $skillsArray); // Trim whitespace

    // Build the SQL query dynamically
    $query = "SELECT * FROM teams WHERE user_id != ? AND (" . implode(' OR ', array_fill(0, count($skillsArray), "team_skills LIKE ?")) . ")";
    $stmt = $conn->prepare($query);

    // Bind the parameters dynamically
    $types = 'i' . str_repeat('s', count($skillsArray)); // 'i' for user_id and 's' for skills
    $params = [$user_id]; // Start with user_id
    foreach ($skillsArray as $skill) {
        $params[] = "%" . $skill . "%"; // Add skills with wildcards
    }

    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display matching teams in a card layout
    if ($result->num_rows > 0) {
        echo "<div class='container_cards'>";
        echo "<h2>Matching Teams</h2>";
        echo "<div class='cards-container'>";

        while ($team = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<h3>" . htmlspecialchars($team['team_name']) . "</h3>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($team['team_description']) . "</p>";
            echo "<p><strong>Skills Needed:</strong> " . htmlspecialchars($team['team_skills']) . "</p>";
            echo "<form onsubmit='return showAlert();'>"; // Attach JavaScript function
            echo "<button type='submit'>Send Request</button>";
            echo "</form>";
            echo "</div>";
        }

        echo "</div>"; // Close cards-container
        echo "</div>"; // Close container_cards
    } else {
        echo "<div class='container_cards'><h2>No matching teams found!</h2></div>";
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
    <title>Join Teams</title>
    <script>
        // Function to display the alert message
        function showAlert() {
            alert("Request sent successfully!");
            return false; // Prevent form submission
        }
    </script>
</head>
<body>
</body>
</html>
