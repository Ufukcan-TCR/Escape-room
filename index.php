<?php
// Gemaakt door: Ufukcan/ Nizar
require_once('dbcon.php');

// TEAM AANMAKEN
if (isset($_POST['create_team'])) {
    $teamName = $_POST['teamName'];

    $stmt = $db_connection->prepare("INSERT INTO teams (teamName) VALUES (:teamName)");
    $stmt->execute(['teamName' => $teamName]);
}

// TEAM JOINEN
if (isset($_POST['join_team'])) {
    $teamId = $_POST['teamId'];
    $playerName = $_POST['playerName'];

    $stmt = $db_connection->prepare("INSERT INTO team_members (teamId, playerName) VALUES (:teamId, :playerName)");
    $stmt->execute(['teamId' => $teamId, 'playerName' => $playerName]);
}

// TEAM VERWIJDEREN
if (isset($_POST['delete_team'])) {
    $teamId = $_POST['teamId'];

    $stmt = $db_connection->prepare("DELETE FROM teams WHERE id = :id");
    $stmt->execute(['id' => $teamId]);
}

// ALLE TEAMS OPHALEN
$teams = $db_connection->query("SELECT * FROM teams")->fetchAll(PDO::FETCH_ASSOC);

// TEAMLEDEN OPHALEN
$teamMembers = $db_connection->query("SELECT * FROM team_members")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="containerH">
    <div class="logo"><img src="Img/Logo Indie.png" alt="Logo van onze web" height="100px"> <h2 class="logo">Indie<br>Escape</h2></div>
    <div class="items">
        <div class="selected">Home</div>
        <div class="item"><a href="Account.php" class="item">Account</a></div>
    </div>
    <div class="item"><a href="Logging.php" class="item">Log in</a></div>
  </header>

  <h1>Welkom bij Indie Escape!</h1>
  <section>
    <div class="section">
      <figure>
        <img src="Img/Create room.png" alt="Create room PNG" height="200px" class="roomImg">
        <figcaption><button><a href="Create.php" class="roomT">Create Room</a></button></figcaption>
      </figure>
      <figure>
        <img src="Img/Join room.png" alt="Join room PNG" height="200px" class="roomImg">
        <figcaption><button><a href="" class="roomT">Join Room</a></button></figcaption>
      </figure>
    </div>
    <div class="description">
      <p>
        Je bent in een kamer gesloten door je vriend die niet goed in de hoofd is. Escape de room zodat hij je niet transformeert in zijn eigen persoonlijke gaming console!
      </p>
    </div>
  </section>

  <!-- TEAM SYSTEEM -->
  <h2>Teams</h2>

  <!-- TEAM AANMAKEN -->
  <form method="POST">
      <input type="text" name="teamName" placeholder="Team naam" required>
      <button type="submit" name="create_team">Team aanmaken</button>
  </form>

  <br>

  <!-- TEAMLIJST -->
  <h3>Bestaande teams:</h3>

  <?php foreach ($teams as $team): ?>
      <div style="margin-bottom: 10px; border: 1px solid #ccc; padding: 10px;">
          <strong><?php echo htmlspecialchars($team['teamName']); ?></strong>

          <!-- JOIN TEAM -->
          <form method="POST" style="display:inline-block; margin-left: 10px;">
              <input type="hidden" name="teamId" value="<?php echo $team['id']; ?>">
              <input type="text" name="playerName" placeholder="Jouw naam" required>
              <button type="submit" name="join_team">Join</button>
          </form>

          <!-- DELETE TEAM -->
          <form method="POST" style="display:inline-block; margin-left: 10px;">
              <input type="hidden" name="teamId" value="<?php echo $team['id']; ?>">
              <button type="submit" name="delete_team">Verwijderen</button>
          </form>

          <!-- TEAMLEDEN TONEN -->
          <div style="margin-top: 10px; padding-left: 10px;">
              <em>Teamleden:</em><br>
              <?php
              $found = false;
              foreach ($teamMembers as $member) {
                  if ($member['teamId'] == $team['id']) {
                      echo "- " . htmlspecialchars($member['playerName']) . "<br>";
                      $found = true;
                  }
              }
              if (!$found) {
                  echo "<span style='color: gray;'>Nog geen teamleden</span>";
              }
              ?>
          </div>

      </div>
  <?php endforeach; ?>

  <button><a href="Winscherm.php">Winscherm</a></button>
  <button><a href="Verliesscherm.php">Verliesscherm</a></button>
  <button><a href="reviewscherm/reviewscherm.php">Reviewschrem</a></button>

  <footer>
    <p>Ufukcan Kaynar</p>
  </footer>
</body>

</html>
