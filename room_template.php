<?php
require_once('../dbcon.php');

$roomImages = [
  1 => [
    0 => ['src' => '', 'alt' => 'Afbeelding vraag 1'],
    1 => ['src' => '', 'alt' => 'Afbeelding vraag 2'],
    2 => ['src' => '', 'alt' => 'Afbeelding vraag 3'],
  ],
  2 => [
    0 => ['src' => '', 'alt' => 'Afbeelding vraag 1'],
    1 => ['src' => '', 'alt' => 'Afbeelding vraag 2'],
    2 => ['src' => '', 'alt' => 'Afbeelding vraag 3'],
  ],
  3 => [
    0 => ['src' => '', 'alt' => 'Afbeelding vraag 1'],
    1 => ['src' => '', 'alt' => 'Afbeelding vraag 2'],
    2 => ['src' => '', 'alt' => 'Afbeelding vraag 3'],
  ],
];

try {
  $stmt = $db_connection->query("SELECT * FROM riddles WHERE roomId = $roomId LIMIT 3");
  $riddles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Databasefout: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Indie Escape – Kamer <?php echo $roomId; ?></title>
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

  <div class="room-header">
    <h1>🚪 Kamer <?php echo $roomId; ?></h1>
    <div id="timer-display">⏱ 05:00</div>
    <nav class="room-nav">
      <a href="../rooms/room_1.php" <?php if ($roomId == 1) echo 'class="current"'; ?>>Kamer 1</a>
      <a href="../rooms/room_2.php" <?php if ($roomId == 2) echo 'class="current"'; ?>>Kamer 2</a>
      <a href="../rooms/room_3.php" <?php if ($roomId == 3) echo 'class="current"'; ?>>Kamer 3</a>
    </nav>
  </div>

  <div class="container">
    <?php foreach ($riddles as $index => $riddle): ?>
    <?php $img = $roomImages[$roomId][$index]; ?>
    <div
      class="box"
      id="box-<?php echo $roomId; ?>-<?php echo $index; ?>"
      onclick="openModal(<?php echo $roomId; ?>, <?php echo $index; ?>)"
      data-room="<?php echo $roomId; ?>"
      data-index="<?php echo $index; ?>"
      data-riddle="<?php echo htmlspecialchars($riddle['riddle']); ?>"
      data-answer="<?php echo htmlspecialchars($riddle['answer']); ?>"
      data-img="<?php echo htmlspecialchars($img['src']); ?>"
      data-img-alt="<?php echo htmlspecialchars($img['alt']); ?>">
      <span class="result-icon" id="icon-<?php echo $roomId; ?>-<?php echo $index; ?>"></span>
      <span class="box-label">Vraag <?php echo $index + 1; ?></span>
    </div>
    <?php endforeach; ?>
  </div>

  <section class="overlay" id="overlay" onclick="closeModal()"></section>

  <section class="modal" id="modal">
    <h2>Vraag</h2>
    <img class="modal-img" id="modal-img" src="" alt="">
    <p id="riddle"></p>
    <input type="text" id="answer" placeholder="Typ je antwoord" onkeydown="if(event.key==='Enter') checkAnswer()">
    <button onclick="checkAnswer()">Verzenden</button>
    <p id="feedback"></p>
  </section>

  <script src="../js/app.js"></script>
</body>
</html>