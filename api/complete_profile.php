<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Profile</title>
    <link rel="stylesheet" href="login_register.css">
</head>
<body>
    <div class="form-container">
        <h2>Complete Your Profile</h2>
        <?php
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: register.php");
            exit;
        }

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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $skills = $_POST['skills'];
            $role = $_POST['role'];
            $availability = $_POST['availability'];
            $user_id = $_SESSION['user_id'];

            // Update user profile
            $stmt = $conn->prepare("UPDATE users SET name = ?, skills = ?, role = ?, availability = ? WHERE id = ?");
            $stmt->bind_param('ssssi', $name, $skills, $role, $availability, $user_id);

            if ($stmt->execute()) {
                echo '<p class="success">Profile updated successfully! Redirecting...</p>';
                echo '<script>setTimeout(() => window.location.href = "home.php", 2000);</script>';
            } else {
                echo '<p class="error">Error updating profile: ' . $stmt->error . '</p>';
            }

            $stmt->close();
        }

        $conn->close();
        ?>
        <form method="POST" action="">
            <p>Name</p>
            <input type="text" name="name" placeholder="Enter your name" required>
            <p>Skills</p>
            <input type="text" name="skills" placeholder="Enter your skills (e.g., JavaScript, Python)" required>
            <p>Role</p>
            <input type="text" name="role" placeholder="Enter your role (e.g., Developer)" required>
            <p>Availability</p>
            <input type="text" name="availability" placeholder="Enter your availability (e.g., Part-time, Full-time)" required>
            <button type="submit">Complete Profile</button>
        </form>
    </div>
</body>
</html>
