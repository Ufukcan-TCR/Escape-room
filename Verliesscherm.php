<?php
require 'dbcon.php'; // database connectie

// voorbeeld: spelernaam
$playerName = "Speler";

// Opslaan in database
$stmt = $db_connection->prepare("
    INSERT INTO results (playerName, result) 
    VALUES (:name, 'lose')
");
$stmt->execute(['name' => $playerName]);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Je hebt gefaald...</title>
    <style>
        body {
            margin: 0;
            font-family: 'Comic Sans MS', sans-serif;
            background: linear-gradient(to bottom, #8b0000, #300000);
            color: #333;
            text-align: center;
        }
        .message-box {
            background-color: rgba(100, 100, 100, 0.8);
            display: inline-block;
            padding: 20px 40px;
            margin-top: 150px;
            border-radius: 10px;
            color: #000;
        }
        .message-box h1 {
            font-family: 'Impact', sans-serif;
        }
        .bottom-icons {
            font-size: 25px;
            margin-top: 60px;
        }
        .home-btn {
            display:inline-block;
            margin-top:30px;
            padding:12px 25px;
            background:#ffcccc;
            color:#000;
            font-weight:bold;
            border-radius:8px;
            text-decoration:none;
            box-shadow:0 0 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h1>Je hebt gefaald...</h1>
        <p>Je missie is mislukt en je faalde om eruit te komen...</p>

        <a href="index.php" class="home-btn">Terug naar homepage</a>
    </div>

    <div class="bottom-icons">
        <?php for ($i = 0; $i < 150; $i++) echo "💀"; ?>
    </div>
</body>
</html>
