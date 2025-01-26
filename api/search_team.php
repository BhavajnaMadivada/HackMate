<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Teams</title>
    <style>
        /* Reuse your existing styles or add new ones */
        body {
            background-color: rgb(45, 11, 45);
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: white;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            text-align: center;
            background-color: #121212;
            color: #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        .search-bar input {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #4caf50;
            border-radius: 5px;
        }
        .team-card {
            background-color: #1f1f1f;
            margin: 10px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .team-card h3 {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Teams</h1>

        <!-- Search Input -->
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search by team name or skills..." oninput="searchTeams()">
        </div>

        <!-- Teams List -->
        <div id="results">
            <p>Start typing to search for teams...</p>
        </div>
    </div>

    <script>
        async function searchTeams() {
            const query = document.getElementById('search').value.trim();

            if (query === '') {
                document.getElementById('results').innerHTML = '<p>Start typing to search for teams...</p>';
                return;
            }

            try {
                const response = await fetch(`search_teams.php?search=${encodeURIComponent(query)}`);
                const teams = await response.json();

                const resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = ''; // Clear previous results

                if (teams.length > 0) {
                    teams.forEach(team => {
                        const card = document.createElement('div');
                        card.className = 'team-card';
                        card.innerHTML = `
                            <h3>${team.team_name}</h3>
                            <p>${team.team_description}</p>
                        `;
                        resultsDiv.appendChild(card);
                    });
                } else {
                    resultsDiv.innerHTML = `<p>No teams found for "${query}".</p>`;
                }
            } catch (error) {
                console.error('Error fetching teams:', error);
                document.getElementById('results').innerHTML = '<p>Failed to fetch teams. Please try again later.</p>';
            }
        }
    </script>
</body>
</html>
