<?php
require_once('../dbcon.php');

$rooms = [];
for ($r = 1; $r <= 3; $r++) {
    try {
        $stmt = $db_connection->query("SELECT * FROM riddles WHERE roomId = $r LIMIT 3");
        $rooms[$r] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Databasefout: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Indie Escape – Kamer</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header class="containerH">
    <div class="logo">
      <img src="../Img/Logo Indie.png" alt="Logo" height="100px">
      <h2 class="logo">Indie<br>Escape</h2>
    </div>
    <div class="items">
      <div class="item"><a href="../index.php" class="item">Home</a></div>
      <div class="item"><a href="../Account.php" class="item">Account</a></div>
    </div>
    <div class="item"><a href="../Logging.php" class="item">Log in</a></div>
  </header>

  <h1>Indie Escape Room</h1>

  <div class="rooms-wrapper">
    <?php foreach ($rooms as $roomId => $riddles): ?>
    <div class="room-section">
      <h2>🚪 Kamer <?php echo $roomId; ?></h2>
      <div class="container">
        <?php foreach ($riddles as $index => $riddle): ?>
        <div
          class="box"
          id="box-<?php echo $roomId; ?>-<?php echo $index; ?>"
          onclick="openModal(<?php echo $roomId; ?>, <?php echo $index; ?>)"
          data-room="<?php echo $roomId; ?>"
          data-index="<?php echo $index; ?>"
          data-riddle="<?php echo htmlspecialchars($riddle['riddle']); ?>"
          data-answer="<?php echo htmlspecialchars($riddle['answer']); ?>">
          <span class="result-icon" id="icon-<?php echo $roomId; ?>-<?php echo $index; ?>"></span>
          <span class="box-label">Vraag <?php echo $index + 1; ?></span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <section class="overlay" id="overlay" onclick="closeModal()"></section>

  <section class="modal" id="modal">
    <h2>Vraag</h2>
    <p id="riddle"></p>
    <input type="text" id="answer" placeholder="Typ je antwoord" onkeydown="if(event.key==='Enter') checkAnswer()">
    <button onclick="checkAnswer()">Verzenden</button>
    <p id="feedback"></p>
  </section>

  <script src="../js/app.js"></script>
</body>
</html>
