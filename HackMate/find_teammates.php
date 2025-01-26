<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Find Teammates</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>Find Teammates</h1>
        <p>Search for teammates to form the perfect hackathon team.</p>
        <form method="GET" action="search_teammates.php">
            <label for="skills">Skills</label>
            <input type="text" id="skills" name="skills" placeholder="E.g., Design, Backend Development" required>
            <label for="availability">Availability</label>
            <input type="text" id="availability" name="availability" placeholder="E.g., Weekends, Full-Time">
            <button type="submit">Search</button>
        </form>
    </main>
</body>
</html>
