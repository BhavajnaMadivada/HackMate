<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login_register.css">
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <?php
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
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            // Check if passwords match
            if ($password !== $password_confirm) {
                echo '<p class="error">Passwords do not match!</p>';
            } else {
                // Check if the email already exists
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    echo '<p class="error">Email is already registered!</p>';
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                    // Insert the new user into the database
                    $insert_stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
                    $insert_stmt->bind_param('ss', $email, $hashed_password);

                    if ($insert_stmt->execute()) {
                        // Registration successful, redirect to complete_profile.php
                        session_start();
                        $_SESSION['user_id'] = $conn->insert_id; // Save user ID in session
                        echo '<p class="success">Registration successful! Redirecting...</p>';
                        echo '<script>setTimeout(() => window.location.href = "complete_profile.php", 2000);</script>';
                    } else {
                        echo '<p class="error">Error registering user: ' . $insert_stmt->error . '</p>';
                    }

                    $insert_stmt->close();
                }

                $stmt->close();
            }
        }

        $conn->close();
        ?>
        <form method="POST" action="">
            <p>Email</p>
            <input type="email" name="email" placeholder="Enter your email" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter your password" required>
            <p>Confirm Password</p>
            <input type="password" name="password_confirm" placeholder="Confirm your password" required>
            <button type="submit">Register</button>
        </form>
        <div class="switch">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
