<?php
//session_start();
//include 'assets/db.php';
//
//$error = "";
//
//if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    $login = trim($_POST['login']);   // Kann Username ODER Email sein
//    $password = trim($_POST['password']);
//
//    if ($login && $password) {
//        // Suche nach Username ODER Email
//        $stmt = $conn->prepare("SELECT id, username, passwort FROM benutzer WHERE username = ? OR email = ?");
//        $stmt->bind_param("ss", $login, $login);
//        $stmt->execute();
//        $stmt->store_result();
//
//        if ($stmt->num_rows > 0) {
//            $stmt->bind_result($id, $username, $hash);
//            $stmt->fetch();
//
//            if (password_verify($password, $hash)) {
//                // Login erfolgreich
//                $_SESSION['user_id'] = $id;
//                $_SESSION['username'] = $username;
//                header("Location: dashboard.php");
//                exit;
//            } else {
//                $error = "❌ Falsches Passwort.";
//            }
//        } else {
//            $error = "❌ Benutzer nicht gefunden.";
//        }
//        $stmt->close();
//    } else {
//        $error = "❌ Bitte alle Felder ausfüllen.";
//    }
//}
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
    <form action="#" method="post">
      <h2>Login</h2>

      <div class="input-field">
        <input type="email" name="email" required>
        <label for="email">E-Mail-Adresse</label>
      </div>

      <div class="input-field">
        <input type="password" name="password" required>
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
<?php include 'footer-login.php'; ?>

</body>
</html>
