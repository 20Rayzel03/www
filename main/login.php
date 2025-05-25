<?php
session_start();

// Beispielhafte Zugangsdaten (nur für Testzwecke!)
$valid_users = [
    'demo@example.de' => 'passwort123',
    'admin@example.de' => 'adminpass'
];

$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($valid_users[$email]) && $valid_users[$email] === $password) {
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        $login_error = "Ungültige Anmeldedaten, bitte erneut versuchen.";
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Anmeldung</title>
  <style>
    /* Reset and base */
    *, *::before, *::after {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
        Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background: linear-gradient(135deg, #243b55 0%, #141e30 100%);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      justify-content: center;
      align-items: center;
      padding: 1rem;
      color: #eff3f7;
    }
    .login-container {
      background: rgba(255 255 255 / 0.08);
      max-width: 420px;
      width: 100%;
      padding: 3rem 2.5rem 3.5rem;
      border-radius: 14px;
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
      backdrop-filter: blur(12px);
      border: 1.5px solid rgba(255 255 255 / 0.15);
      box-sizing: border-box;
      text-align: center;
      user-select: none;
      transition: background-color 0.3s ease;
    }
    .login-container:hover {
      background: rgba(255 255 255 / 0.12);
    }
    .login-container h1 {
      margin-bottom: 2rem;
      font-weight: 900;
      font-size: 2.5rem;
      letter-spacing: 0.02em;
      text-shadow: 0 2px 8px rgba(0,0,0,0.8);
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 1.4rem;
      color: #e2e8f0;
      user-select: text;
    }
    label {
      font-weight: 700;
      font-size: 1.05rem;
      margin-bottom: 0.35rem;
      text-align: left;
      color: #cbd5e1;
      user-select: text;
    }
    input[type="email"],
    input[type="password"] {
      padding: 0.75rem 1rem;
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      outline: none;
      transition: box-shadow 0.3s ease, background-color 0.3s ease;
      background-color: rgba(255 255 255 / 0.15);
      color: #f1f5f9;
      user-select: text;
      box-shadow: inset 0 0 4px rgba(0,0,0,0.3);
    }
    input[type="email"]::placeholder,
    input[type="password"]::placeholder {
      color: #bec8d2;
      font-style: italic;
    }
    input[type="email"]:focus,
    input[type="password"]:focus {
      background-color: rgba(255 255 255 / 0.3);
      box-shadow: 0 0 12px 2px #66a9ff;
      color: #eff3f7;
    }
    button[type="submit"] {
      margin-top: 1rem;
      background-color: #0078d7;
      border: none;
      color: white;
      padding: 0.85rem 0;
      font-size: 1.2rem;
      border-radius: 12px;
      font-weight: 900;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(0, 120, 215, 0.6);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
    }
    button[type="submit"]:hover,
    button[type="submit"]:focus {
      background-color: #005ea2;
      box-shadow: 0 12px 28px rgba(0, 94, 162, 0.85);
      outline: none;
    }
    .info-text {
      margin-top: 1.8rem;
      font-size: 0.95rem;
      color: #9bb4d6;
      user-select: text;
    }
    .info-text a {
      color: #bbe1ff;
      font-weight: 700;
      text-decoration: none;
      transition: color 0.25s ease;
    }
    .info-text a:hover,
    .info-text a:focus {
      color: #d3e9ff;
      text-decoration: underline;
      outline: none;
    }
    .error-message {
      background-color: #f4433640;
      color: #b71c1c;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      margin-bottom: 1.4rem;
      font-weight: 700;
      font-size: 1rem;
      box-shadow: 0 2px 6px #b71c1c80;
      user-select: text;
    }
    @media (max-width: 480px) {
      .login-container {
        padding: 2.2rem 1.8rem 2.8rem;
      }
      .login-container h1 {
        font-size: 2rem;
      }
      form {
        gap: 1rem;
      }
      label, input[type="email"], input[type="password"], button[type="submit"] {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <main>
    <section class="login-container" aria-label="Anmeldeformular">
      <h1>Willkommen zurück!</h1>
      <?php if (!empty($login_error)): ?>
      <div class="error-message"><?php echo htmlspecialchars($login_error); ?></div>
      <?php endif; ?>

      <form action="login.php" method="post" novalidate>
        <label for="email">E-Mail Adresse</label>
        <input
          type="email"
          id="email"
          name="email"
          autocomplete="email"
          required
          placeholder="deine.email@example.de"
          aria-describedby="emailHelp"
        />

        <label for="password">Passwort</label>
        <input
          type="password"
          id="password"
          name="password"
          autocomplete="current-password"
          required
          placeholder="Passwort eingeben"
        />

        <button type="submit" aria-label="Anmelden">Anmelden</button>
      </form>

      <div class="info-text">
        Kein Konto? <a href="register.html">Jetzt registrieren</a>
      </div>
    </section>
  </main>
</body>
</html>