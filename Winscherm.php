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
    </style>
</head>
<body>
    <div class="top-icons">
        <?php for ($i = 0; $i < 40; $i++) echo "👍"; ?>
    </div>

    <div class="message-box">
        <h1>Het is je gelukt!</h1>
        <p>Je hebt elke puzzel en raadsel opgelost,<br>je bent een echte indie-expert!</p>
    </div>

    <div class="bottom-icons">
        <?php for ($i = 0; $i < 100; $i++) echo "✅"; ?>
    </div>
</body>
</html>
