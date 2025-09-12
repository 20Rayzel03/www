<?php
session_start();
include 'assets/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login']);   // Kann Username ODER Email sein
    $password = trim($_POST['password']);

    if ($login && $password) {
        // Suche nach Username ODER Email
        $stmt = $conn->prepare("SELECT id, username, passwort FROM benutzer WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $login, $login);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hash);
            $stmt->fetch();

            if (password_verify($password, $hash)) {
                // Login erfolgreich
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "❌ Falsches Passwort.";
            }
        } else {
            $error = "❌ Benutzer nicht gefunden.";
        }
        $stmt->close();
    } else {
        $error = "❌ Bitte alle Felder ausfüllen.";
    }
}
?>

<?php include 'assets/header.php'; ?>

<header>
  <h1>Anmelden</h1>
</header>

<main>
  <section class="container">
    <?php if ($error): ?>
      <div style="padding:1rem; background:#ffe6e6; border:1px solid #f44336; border-radius:8px; margin-bottom:1rem;">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form class="contact-form" action="login.php" method="post">
      <label for="login">Benutzername oder E-Mail</label>
      <input type="text" id="login" name="login" required>

      <label for="password">Passwort</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </section>
</main>

<?php include 'assets/footer.php'; ?>
