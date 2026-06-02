<?php
require 'dbcon.php'; // database connectie

// voorbeeld: spelernaam (pas aan als je een echte naam hebt)
$playerName = "Speler";

// Opslaan in database
$stmt = $db_connection->prepare("
    INSERT INTO results (playerName, result) 
    VALUES (:name, 'win')
");
$stmt->execute(['name' => $playerName]);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Het is je gelukt!</title>
    <style>
        body {
            margin: 0;
            font-family: 'Comic Sans MS', sans-serif;
            background: linear-gradient(to bottom, #4ef037, #0b6e00);
            color: #000;
            text-align: center;
        }
        .top-icons {
            font-size: 40px;
            margin-top: 10px;
        }
        .message-box {
            background-color: white;
            display: inline-block;
            padding: 20px 40px;
            margin-top: 100px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
        .message-box h1 {
            font-family: 'Impact', sans-serif;
            font-style: italic;
        }
        .bottom-icons {
            font-size: 30px;
            margin-top: 50px;
        }
        .home-btn {
            display:inline-block;
            margin-top:30px;
            padding:12px 25px;
            background:#ffffff;
            color:#000;
            font-weight:bold;
            border-radius:8px;
            text-decoration:none;
            box-shadow:0 0 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="top-icons">
        <?php for ($i = 0; $i < 40; $i++) echo "👍"; ?>
    </div>

    <div class="message-box">
        <h1>Het is je gelukt!</h1>
        <p>Je hebt elke puzzel en raadsel opgelost,<br>je bent een echte indie-expert!</p>

        <a href="index.php" class="home-btn">Terug naar homepage</a>
    </div>

    <div class="bottom-icons">
        <?php for ($i = 0; $i < 100; $i++) echo "✅"; ?>
    </div>
</body>
</html>
