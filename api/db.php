<?php
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "1234";  // Your MySQL password
$dbname = "hackmate";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists, and create it if it doesn't
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists.";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Check if the "users" table exists, and create it if it doesn't
$table_sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";



if ($conn->query($table_sql) === TRUE) {
    echo "Table 'users' created or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}

$alter_queries = [
    "ALTER TABLE users ADD COLUMN name VARCHAR(100)",
    "ALTER TABLE users ADD COLUMN skills TEXT",
    "ALTER TABLE users ADD COLUMN role VARCHAR(100)",
    "ALTER TABLE users ADD COLUMN availability VARCHAR(100)"
];

foreach ($alter_queries as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Column added successfully (or already exists): " . $query . "<br>";
    } else {
        echo "Error adding column: " . $conn->error . "<br>";
    }
}

$table_sql = "CREATE TABLE IF NOT EXISTS teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hackathon_name VARCHAR(255) NOT NULL,
    team_name VARCHAR(255) NOT NULL,
    team_description TEXT,
    team_skills VARCHAR(255),
    country VARCHAR(100),
    contact_email VARCHAR(255),
    github_url VARCHAR(255),
    twitter_url VARCHAR(255),
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";


// Close the connection
$conn->close();
?>
