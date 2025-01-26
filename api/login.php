<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login_register.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php
        session_start(); // Start the session

        $conn = new mysqli("localhost", "root", "1234", "hackmate");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Prepare and bind
            $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email); // "s" means the type is string
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $email;

                    echo '<p class="success">Login successful! Redirecting...</p>';
                    echo '<script>setTimeout(() => window.location.href = "home.php", 2000);</script>';
                } else {
                    echo '<p class="error">Invalid email or password!</p>';
                }
            } else {
                echo '<p class="error">No user found with that email!</p>';
            }

            $stmt->close();
        }

        $conn->close();
        ?>
        <form method="POST" action="">
            <p>Email</p>
            <input type="email" name="email" placeholder="Enter your email" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>
        <div class="switch">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
