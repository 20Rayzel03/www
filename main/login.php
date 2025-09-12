<?php
session_start();
include 'assets/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username && $password) {
        $stmt = $conn->prepare("SELECT id, passwort FROM benutzer WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hash);
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
      <label for="username">Benutzername</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Passwort</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </section>
</main>

<?php include 'assets/footer.php'; ?>
