<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join a Team</title>
    <style>

        .container2 h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #FFFFFF;
            text-align:center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s;
        }

        input:focus, select:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 5px #6c63ff;
        }

        button {
            background-color: #6c63ff;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            background-color: #4b4fff;
        }

        button:active {
            transform: scale(0.97);
        }
    </style>
</head>
<body>
    <div class="container2" id="join">
        <div class="srmap">
            <h2>Join Into a Team</h2>
        </div>
        <form id="teamForm" method="POST" action="join_team.php">
            <input type="text" id="name" name="name" placeholder="Your Name" required>
            <input type="text" id="skills" name="skills" placeholder="Your Skills (e.g., JavaScript, Design)" required>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select Your Role</option>
                <option value="Developer">Developer</option>
                <option value="Designer">Designer</option>
                <option value="Business">Business Strategist</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" id="availability" name="availability" placeholder="Your availability description" required>
            <button type="submit">Find Teams</button>
        </form>
    </div>
</body>
</html>
