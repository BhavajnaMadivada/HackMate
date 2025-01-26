<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Find a Team</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>Find a Team</h1>
        <p>Search for teams participating in hackathons globally.</p>
        <form method="GET" action="search_teams.php">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter location" required>
            <label for="skills">Skills</label>
            <input type="text" id="skills" name="skills" placeholder="E.g., Web Development, AI">
            <button type="submit">Search</button>
        </form>
    </main>
</body>
</html>
