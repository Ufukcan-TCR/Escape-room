<!DOCTYPE html>
<!-- Gemaakt door: Nizar -->
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Het is je gelukt!</title>
    <link rel="stylesheet" href="css/winscherm.css">

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
