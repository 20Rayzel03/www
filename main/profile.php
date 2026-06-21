<?php
require_once __DIR__ . '/assets/auth.php';
require_login();
require_once __DIR__ . '/assets/db.php';

$pageTitle = 'Profil bearbeiten';
$userId = (int)$_SESSION['user_id'];
$success = '';
$error = '';

$stmt = $conn->prepare('SELECT username, email FROM benutzer WHERE id = ? LIMIT 1');
$stmt->bind_param('i', $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'profile') {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($username === '' || $email === '') {
            $error = 'Bitte Benutzername und E-Mail ausfüllen.';
        } elseif (strlen($username) < 3 || strlen($username) > 32) {
            $error = 'Benutzername muss zwischen 3 und 32 Zeichen lang sein.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Bitte eine gültige E-Mail-Adresse angeben.';
        } else {
            $check = $conn->prepare('SELECT id FROM benutzer WHERE (username = ? OR email = ?) AND id <> ? LIMIT 1');
            $check->bind_param('ssi', $username, $email, $userId);
            $check->execute();
            $check->store_result();
            if ($check->num_rows > 0) {
                $error = 'Benutzername oder E-Mail ist bereits vergeben.';
            }
            $check->close();

            if ($error === '') {
                $update = $conn->prepare('UPDATE benutzer SET username = ?, email = ? WHERE id = ?');
                $update->bind_param('ssi', $username, $email, $userId);
                if ($update->execute()) {
                    $_SESSION['username'] = $username;
                    $user['username'] = $username;
                    $user['email'] = $email;
                    $success = 'Profil wurde gespeichert.';
                } else {
                    $error = 'Profil konnte nicht gespeichert werden.';
                }
                $update->close();
            }
        }
    }

    if ($action === 'password') {
        $current = (string)($_POST['current_password'] ?? '');
        $new = (string)($_POST['new_password'] ?? '');
        $confirm = (string)($_POST['new_password_confirm'] ?? '');

        $pw = $conn->prepare('SELECT passwort FROM benutzer WHERE id = ? LIMIT 1');
        $pw->bind_param('i', $userId);
        $pw->execute();
        $row = $pw->get_result()->fetch_assoc();
        $pw->close();

        if (!$row || !password_verify($current, $row['passwort'])) {
            $error = 'Aktuelles Passwort ist falsch.';
        } elseif (strlen($new) < 8) {
            $error = 'Das neue Passwort muss mindestens 8 Zeichen lang sein.';
        } elseif ($new !== $confirm) {
            $error = 'Die neuen Passwörter stimmen nicht überein.';
        } else {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $up = $conn->prepare('UPDATE benutzer SET passwort = ? WHERE id = ?');
            $up->bind_param('si', $hash, $userId);
            if ($up->execute()) {
                $success = 'Passwort wurde geändert.';
            } else {
                $error = 'Passwort konnte nicht geändert werden.';
            }
            $up->close();
        }
    }
}

include 'assets/header.php';
?>
<header class="page-hero"><div class="container"><span class="eyebrow">Konto</span><h1>Benutzerbereich</h1><p>Hier kannst du deine Kontodaten anpassen.</p></div></header>
<main class="section"><div class="container grid grid-2">
  <section class="glass-card">
    <h2>Profil bearbeiten</h2>
    <?php if ($success): ?><div class="alert ok"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post" class="admin-form">
      <input type="hidden" name="action" value="profile">
      <div><label for="username">Benutzername</label><input id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required></div>
      <div><label for="email">E-Mail-Adresse</label><input id="email" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></div>
      <button class="btn btn-primary" type="submit">Profil speichern</button>
    </form>
  </section>
  <section class="glass-card">
    <h2>Passwort ändern</h2>
    <form method="post" class="admin-form">
      <input type="hidden" name="action" value="password">
      <div><label for="current_password">Aktuelles Passwort</label><input id="current_password" type="password" name="current_password" autocomplete="current-password" required></div>
      <div><label for="new_password">Neues Passwort</label><input id="new_password" type="password" name="new_password" autocomplete="new-password" required></div>
      <div><label for="new_password_confirm">Neues Passwort bestätigen</label><input id="new_password_confirm" type="password" name="new_password_confirm" autocomplete="new-password" required></div>
      <button class="btn btn-primary" type="submit">Passwort ändern</button>
    </form>
  </section>
  <section class="glass-card" style="grid-column:1/-1">
    <h2>Weitere Bereiche</h2>
    <p class="muted">Von hier kommst du zurück zum Dashboard oder direkt zu den Blogposts.</p>
    <p><a class="btn btn-ghost" href="dashboard.php">← Dashboard</a> <a class="btn btn-primary" href="blog.php">Blogposts öffnen</a></p>
  </section>
</div></main>
<?php include 'assets/footer.php'; ?>
