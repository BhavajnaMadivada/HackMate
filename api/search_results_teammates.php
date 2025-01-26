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

// Get the search parameters
$role = $_POST['roleSearch'];
$skills = $_POST['skillSearch'];

// Search for teammates
$stmt = $conn->prepare("SELECT * FROM users WHERE role = ? AND skills LIKE ?");
$search_skills = "%" . $skills . "%";
$stmt->bind_param("ss", $role, $search_skills);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            background-color: #0d1117;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #161b22;
            padding: 10px 0;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            border-bottom: 2px solid #6c63ff;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background-color: #21262d;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            color: white;
            position: relative;
            height:150px; 
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
        }

        .card p {
            margin: 10px 0;
        }

        .plus-icon {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #6c63ff;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .plus-icon:hover {
            background-color: #584bff;
        }

        .no-results {
            text-align: center;
            font-size: 18px;
            color: #aaa;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Results</h2>
        <?php if ($result->num_rows > 0): ?>
            <div class="grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                        <p><strong>Role:</strong> <?php echo htmlspecialchars($row['role']); ?></p>
                        <p><strong>Skills:</strong> <?php echo htmlspecialchars($row['skills']); ?></p>
                        <button class="plus-icon" onclick="addTeammate('<?php echo htmlspecialchars($row['name']); ?>')">+</button>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-results">No results found.</p>
        <?php endif; ?>
    </div>

    <script>
        function addTeammate(name) {
            alert('Request sent to ' + name + ' to join your team!');
        }
    </script>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
