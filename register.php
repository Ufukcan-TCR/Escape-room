<?php
// Gemaakt door: Jezion (gefixed)
require_once 'dbcon.php';
session_start();
 
// Al ingelogd? Stuur door naar home
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
 
$error   = '';
$success = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
 
    if ($username === '' || $password === '' || $confirm === '') {
        $error = 'Vul alle velden in.';
    } elseif (strlen($username) < 3) {
        $error = 'Gebruikersnaam moet minimaal 3 tekens lang zijn.';
    } elseif (strlen($password) < 6) {
        $error = 'Wachtwoord moet minimaal 6 tekens lang zijn.';
    } elseif ($password !== $confirm) {
        $error = 'Wachtwoorden komen niet overeen.';
    } else {
        // Controleer of gebruikersnaam al bestaat
        $stmt = $db_connection->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
 
        if ($stmt->fetch()) {
            $error = 'Gebruikersnaam is al in gebruik. Kies een andere.';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $db_connection->prepare(
                "INSERT INTO users (username, password, is_admin) VALUES (:username, :password, 0)"
            );
            $insert->execute(['username' => $username, 'password' => $hashed]);
 
            $success = 'Registratie succesvol! Je kunt nu <a href="Logging.php">inloggen</a>.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren – Indie Escape</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="containerH">
        <div class="logo">
            <img src="Img/Logo Indie.png" alt="Logo" height="100px">
            <h2 class="logo">Indie<br>Escape</h2>
        </div>
        <div class="items">
            <div class="item"><a href="index.php" class="item">Home</a></div>
        </div>
        <div class="item"><a href="Logging.php" class="item">Inloggen</a></div>
    </header>
 
    <div class="auth-box">
        <h2>Registreren</h2>
 
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
 
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
 
        <form method="POST">
            <label for="username">Gebruikersnaam</label>
            <input type="text" id="username" name="username"
                   value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                   required autofocus>
 
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
 
            <label for="confirm_password">Wachtwoord bevestigen</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
 
            <button type="submit">Registreren</button>
        </form>
 
        <p class="link">Heb je al een account? <a href="Logging.php">Log hier in</a>.</p>
    </div>
</body>
</html>