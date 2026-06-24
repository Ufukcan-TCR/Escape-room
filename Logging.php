<?php
// Gemaakt door: Jezion (gefixed)
require_once 'dbcon.php';
session_start();
 
// Al ingelogd? Stuur door naar home
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
 
$error = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
 
    if ($username === '' || $password === '') {
        $error = 'Vul alle velden in.';
    } else {
        $stmt = $db_connection->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = ($user['is_admin'] == 1) ? 'admin' : 'user';
 
            header('Location: index.php');
            exit();
        } else {
            $error = 'Ongeldige gebruikersnaam of wachtwoord.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen – Indie Escape</title>
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
        <div class="item"><a href="register.php" class="item">Registreren</a></div>
    </header>
 
    <div class="auth-box">
        <h2>Inloggen</h2>
 
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
 
        <form method="POST">
            <label for="username">Gebruikersnaam</label>
            <input type="text" id="username" name="username"
                   value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                   required autofocus>
 
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
 
            <button type="submit">Inloggen</button>
        </form>
 
        <p class="link">Nog geen account? <a href="register.php">Registreer hier</a>.</p>
    </div>
</body>
</html>