<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hack Mate</title>
    <style>
        /* Styling for index.php */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(45, 11, 45);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Header styling */
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.6);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        header .logo {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 3px;
        }

        header .highlight {
            color: violet;
        }

        /* Header buttons */
        .header-buttons {
            display: flex;
            gap: 10px;
            padding:10px;
            padding-right:50px;
        }

        .header-buttons a {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            text-decoration: none;
            border: 2px solid violet;
            border-radius: 30px;
            transition: background-color 0.3s, color 0.3s;
        }

        .header-buttons a:hover {
            background-color: violet;
            color: white;
        }

        /* Gradient effect for HackMate in slogan */
        .gradient-text {
            background: linear-gradient(to right, violet, pink, darkviolet);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* 3D effect for Hackathon text */
        .three-d-text {
            font-size: 80px;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 2px rgba(255, 255, 255, 0.9),
                         3px 3px 2px rgba(255, 255, 255, 0.8),
                         4px 4px 2px rgba(255, 255, 255, 0.7),
                         5px 5px 1px rgba(255, 255, 255, 0.9);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Elevated slogan styling */
        .elevated-slogan {
            font-size: 81px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #fff;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
        }

        .slogan {
            font-size: 27px;
            margin-bottom: 30px;
            color: #ccc;
        }

        .get-started-btn {
            padding: 15px 30px;
            font-size: 36px;
            font-weight: bold;
            background-color: violet;
            color: white;
            text-decoration: none;
            border-radius: 9px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .get-started-btn:hover {
            background-color: darkviolet;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            Hack<span class="highlight">Mate</span>
        </div>
        <div class="header-buttons">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </header>

    <div class="content">
        <!-- Elevated slogan with gradient HackMate -->
        <p class="elevated-slogan">Transform Your <span class="three-d-text">Hackathon</span> Experience - <span class="gradient-text">HackMate</span>: Where Visionaries Unite.</p>
        <p class="slogan">"Teamwork Makes the Dream Work - HackMate is Here to Help You Conquer Hackathons."</p>
        <a href="register.php" class="get-started-btn">Get Started</a>
    </div>
</body>
</html>
