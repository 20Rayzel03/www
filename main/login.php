<?php
session_start();
include './assets/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($login !== '' && $password !== '') {
        $sql = "SELECT id, username, passwort FROM benutzer WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $error = "Serverfehler (DB-Prepare).";
        } else {
            $stmt->bind_param("ss", $login, $login);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($id, $username, $hash);
                $stmt->fetch();

                if (is_string($hash) && password_verify($password, $hash)) {
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php");
                    exit;
                }
                $error = "❌ Falsches Passwort.";
            } else {
                $error = "❌ Benutzer nicht gefunden.";
            }
            $stmt->close();
        }
    } else {
        $error = "❌ Bitte alle Felder ausfüllen.";
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | JQPOLLAG.DE</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="wrapper">
    <form action="" method="post" novalidate>
      <h2>Login</h2>

      <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
      <?php endif; ?>

      <div class="input-field">
        <input type="text" name="login" autocomplete="username" required>
        <label for="login">E-Mail-Adresse oder Benutzername</label>
      </div>

      <div class="input-field">
        <input type="password" name="password" autocomplete="current-password" required>
        <label for="password">Passwort</label>
      </div>

      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember" name="remember">
          <span>Angemeldet bleiben</span>
        </label>
        <a href="kontakt.php">Passwort vergessen?</a>
      </div>

      <button type="submit">Anmelden</button>

      <div class="register">
        <p>Noch kein Konto? <a href="register.php">Registrieren</a></p>
      </div>
    </form>
  </div>
  <?php include 'assets/footer-login.php'; ?>
</body>
</html>
