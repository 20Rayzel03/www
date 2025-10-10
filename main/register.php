<?php include 'assets/header.php'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrierung | JQPOLLAG.DE</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="wrapper">
    <form action="register.php" method="post">
      <h2>Registrierung</h2>

      <?php if (!empty($error)): ?>
        <div class="login-error" style="padding:1rem; background:#ffe6e6; border:1px solid #f44336; border-radius:8px; margin-bottom:1.5rem; color:#000;">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <div class="input-field">
        <input type="text" id="username" name="username" required>
        <label for="username">Benutzername</label>
      </div>

      <div class="input-field">
        <input type="email" id="email" name="email" required>
        <label for="email">E-Mail-Adresse</label>
      </div>

      <div class="input-field">
        <input type="password" id="password" name="password" required>
        <label for="password">Passwort</label>
      </div>

      <div class="input-field">
        <input type="password" id="password_confirm" name="password_confirm" required>
        <label for="password_confirm">Passwort bestätigen</label>
      </div>

      <button type="submit">Registrieren</button>

      <div class="register">
        <p>Du hast schon ein Konto? <a href="login.php">Anmelden</a></p>
      </div>
    </form>
  </div>

  <?php include 'assets/footer.php'; ?>
</body>
</html>
