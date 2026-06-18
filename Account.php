<?php 
// Gemaakt door: Jezion

require_once 'config.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            if ($row['is_admin'] == 1) {
                $_SESSION['role'] = 'admin';
            } else {
                $_SESSION['role'] = 'user';
            }

            header('Location: index.php');
            exit();
        } else {
            echo "Ongeldige gebruikersnaam of wachtwoord.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="username">Gebruikersnaam:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Wachtwoord:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Inloggen</button>
</form>
<br>
    <p>Heb je nog geen account? <a href="register.php">Registreer hier</a>.</p>
    
</body>
</html>