<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Teammates</title>
    <style>
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
        .teammate-card {
            background-color: #1f1f1f;
            margin: 10px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .teammate-card h3 {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Teammates</h1>

        <!-- Search Input -->
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search by name or skills..." oninput="searchTeammates()">
        </div>

        <!-- Teammates List -->
        <div id="results">
            <p>Start typing to search for teammates...</p>
        </div>
    </div>

    <script>
        async function searchTeammates() {
            const query = document.getElementById('search').value.trim();

            if (query === '') {
                document.getElementById('results').innerHTML = '<p>Start typing to search for teammates...</p>';
                return;
            }

            try {
                const response = await fetch(`search_teammates.php?search=${encodeURIComponent(query)}`);
                const teammates = await response.json();

                const resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = ''; // Clear previous results

                if (teammates.length > 0) {
                    teammates.forEach(teammate => {
                        const card = document.createElement('div');
                        card.className = 'teammate-card';
                        card.innerHTML = `
                            <h3>${teammate.name}</h3>
                            <p><strong>Skills:</strong> ${teammate.skills}</p>
                            <p><strong>Role:</strong> ${teammate.role}</p>
                        `;
                        resultsDiv.appendChild(card);
                    });
                } else {
                    resultsDiv.innerHTML = `<p>No teammates found for "${query}".</p>`;
                }
            } catch (error) {
                console.error('Error fetching teammates:', error);
                document.getElementById('results').innerHTML = '<p>Failed to fetch teammates. Please try again later.</p>';
            }
        }
    </script>
</body>
</html>
