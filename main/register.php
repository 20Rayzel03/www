<?php
session_start();
require_once __DIR__ . '/assets/db.php';


$REGISTRATION_OPEN = true; 
$LOCKFILE = __DIR__ . '/.registration_closed';

function isRegistrationOpen(bool $flag, string $lockFile): bool {
    if (is_file($lockFile)) return false;
    return $flag;
}

$registrationEnabled = isRegistrationOpen($REGISTRATION_OPEN, $LOCKFILE);

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!$registrationEnabled) {
        $error = "🚫 Registrierung ist derzeit deaktiviert.";
    } else {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? (string)$_POST['password'] : '';
        $password_confirm = isset($_POST['password_confirm']) ? (string)$_POST['password_confirm'] : '';

        if ($username === '' || $email === '' || $password === '' || $password_confirm === '') {
            $error = "❌ Bitte alle Felder ausfüllen.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "❌ Ungültige E-Mail-Adresse.";
        } elseif (mb_strlen($username) < 3 || mb_strlen($username) > 32) {
            $error = "❌ Benutzername muss zwischen 3 und 32 Zeichen lang sein.";
        } elseif ($password !== $password_confirm) {
            $error = "❌ Passwörter stimmen nicht überein.";
        } elseif (mb_strlen($password) < 8) {
            $error = "❌ Passwort muss mindestens 8 Zeichen lang sein.";
        } else {
            $sqlCheck = "SELECT id FROM benutzer WHERE username = ? OR email = ? LIMIT 1";
            if (!$stmt = $conn->prepare($sqlCheck)) {
                $error = "Serverfehler (DB-Prepare Check).";
            } else {
                $stmt->bind_param("ss", $username, $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $error = "❌ Benutzername oder E-Mail bereits vergeben.";
                }
                $stmt->close();
            }

            if ($error === "") {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sqlInsert = "INSERT INTO benutzer (username, email, passwort) VALUES (?, ?, ?)";
                if (!$stmt = $conn->prepare($sqlInsert)) {
                    $error = "Serverfehler (DB-Prepare Insert).";
                } else {
                    $stmt->bind_param("sss", $username, $email, $hash);
                    if ($stmt->execute()) {
                        $success = "✅ Registrierung erfolgreich! Du kannst dich jetzt <a href=\"login.php\">anmelden</a>.";
                        $username = $email = "";
                    } else {
                        if ($conn->errno === 1062) {
                            $error = "❌ Benutzername oder E-Mail bereits vergeben.";
                        } else {
                            $error = "❌ Konnte nicht registrieren (DB-Fehler).";
                        }
                    }
                    $stmt->close();
                }
            }
        }
    }
}

$usernameVal = isset($username) ? htmlspecialchars($username, ENT_QUOTES, 'UTF-8') : '';
$emailVal    = isset($email) ? htmlspecialchars($email, ENT_QUOTES, 'UTF-8') : '';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrierung | JQPOLLAG.DE</title>
  <link rel="stylesheet" href="assets/css/login.css">
  <style>
    .login-error{padding:1rem;background:#ffe6e6;border:1px solid #f44336;border-radius:8px;margin-bottom:1.5rem;color:#000;}
    .login-success{padding:1rem;background:#e7f7ee;border:1px solid #28a745;border-radius:8px;margin-bottom:1.5rem;color:#000;}
    .note{font-size:.9rem;opacity:.8;margin:.5rem 0 1rem;}
    .disabled-overlay{opacity:.6;pointer-events:none;}
    .note {
        font-size: .9rem;
        opacity: .8;
        margin: .5rem 0 1rem;
        color: #919191ff;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="register.php" method="post" <?= $registrationEnabled ? '' : 'class="disabled-overlay"' ?>>
      <h2>Registrierung</h2>

      <?php if (!empty($error)): ?>
        <div class="login-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="login-success"><?= $success ?></div>
      <?php endif; ?>

      <?php if (!$registrationEnabled): ?>
        <p class="note">🚧 Die Registrierung ist aktuell deaktiviert. Bitte probiere es später erneut.</p>
      <?php else: ?>
        <p class="note">Fülle die Felder aus, um ein neues Konto zu erstellen.</p>
      <?php endif; ?>

      <div class="input-field">
        <input type="text" id="username" name="username" value="<?= $usernameVal ?>" required <?= $registrationEnabled ? '' : 'disabled' ?>>
        <label for="username">Benutzername</label>
      </div>

      <div class="input-field">
        <input type="email" id="email" name="email" value="<?= $emailVal ?>" required <?= $registrationEnabled ? '' : 'disabled' ?>>
        <label for="email">E-Mail-Adresse</label>
      </div>

      <div class="input-field">
        <input type="password" id="password" name="password" required <?= $registrationEnabled ? '' : 'disabled' ?>>
        <label for="password">Passwort</label>
      </div>

      <div class="input-field">
        <input type="password" id="password_confirm" name="password_confirm" required <?= $registrationEnabled ? '' : 'disabled' ?>>
        <label for="password_confirm">Passwort bestätigen</label>
      </div>

      <button type="submit" <?= $registrationEnabled ? '' : 'disabled' ?>>
        <?= $registrationEnabled ? 'Registrieren' : 'Registrierung deaktiviert' ?>
      </button>

      <div class="register">
        <p>Du hast schon ein Konto? <a href="login.php">Anmelden</a></p>
      </div>
    </form>
  </div>

  <?php include __DIR__ . '/assets/footer-login.php'; ?>
</body>
</html>
