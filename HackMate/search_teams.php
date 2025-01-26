<?php
// Database connection
$host = 'localhost';
$dbname = 'hackathon';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}

// Fetch teams
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $location = $_GET['location'];
    $skills = $_GET['skills'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM teams WHERE location LIKE :location AND skills LIKE :skills");
        $stmt->bindValue(':location', "%$location%");
        $stmt->bindValue(':skills', "%$skills%");
        $stmt->execute();
        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h1>Teams Found</h1>";
        if ($teams) {
            foreach ($teams as $team) {
                echo "<p><strong>Team Name:</strong> " . htmlspecialchars($team['name']) . "<br>";
                echo "<strong>Location:</strong> " . htmlspecialchars($team['location']) . "<br>";
                echo "<strong>Skills:</strong> " . htmlspecialchars($team['skills']) . "</p>";
            }
        } else {
            echo "<p>No teams found.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
