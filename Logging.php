<?php
// Gemaakt door: Jezion
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_sql = "SELECT * FROM users WHERE username='$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Gebruikersnaam is al in gebruik. Kies een andere.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "Registratie successvol";
        } else {
            echo "Fout bij registratie: " . $conn->error;
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
    <h2>Registratie</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="username">Gebruikersnaam:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Wachtwoord:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Registreren</button>
    </form>
    <p>Heb je al een account? <a href="login.php">Log hier in</a>.</p>

</body>
</html>