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

// Fetch teammates
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $skills = $_GET['skills'];
    $availability = $_GET['availability'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM teammates WHERE skills LIKE :skills AND availability LIKE :availability");
        $stmt->bindValue(':skills', "%$skills%");
        $stmt->bindValue(':availability', "%$availability%");
        $stmt->execute();
        $teammates = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h1>Teammates Found</h1>";
        if ($teammates) {
            foreach ($teammates as $teammate) {
                echo "<p><strong>Name:</strong> " . htmlspecialchars($teammate['name']) . "<br>";
                echo "<strong>Skills:</strong> " . htmlspecialchars($teammate['skills']) . "<br>";
                echo "<strong>Availability:</strong> " . htmlspecialchars($teammate['availability']) . "</p>";
            }
        } else {
            echo "<p>No teammates found.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
