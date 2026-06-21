<?php
require_once __DIR__ . '/assets/auth.php';
require_login();
$pageTitle = 'Dashboard';
include 'assets/header.php';
?>
<header class="page-hero"><div class="container"><span class="eyebrow">Interner Bereich</span><h1>Dashboard</h1><p>Willkommen, <?= htmlspecialchars($_SESSION['username']); ?>! 🎉 Hier verwaltest du dein Konto und kommst zu deinen persönlichen Bereichen.</p></div></header>
<main class="section"><div class="container">
  <div class="dashboard-grid user-dashboard-grid">
    <a class="data-card" href="profile.php"><div class="card-icon">👤</div><h3>Benutzerbereich</h3><p class="muted">Passe deinen Benutzernamen, deine E-Mail-Adresse und dein Passwort an.</p><span class="btn btn-ghost">Profil bearbeiten</span></a>
    <a class="data-card" href="blog.php"><div class="card-icon">📰</div><h3>Blogposts</h3><p class="muted">Zum Blogbereich. Später können hier auch Beiträge erscheinen, die nur mit Benutzerkonto lesbar sind.</p><span class="btn btn-ghost">Zum Blog</span></a>
    <?php if (is_admin()): ?>
      <a class="data-card" href="anfragen.php"><div class="card-icon">📩</div><h3>Kontaktanfragen</h3><p class="muted">Kontaktanfragen ansehen und nachverfolgen.</p><span class="btn btn-ghost">Anfragen öffnen</span></a>
      <a class="data-card" href="blog_admin.php"><div class="card-icon">✍️</div><h3>Blog verwalten</h3><p class="muted">Blogbeiträge in der Datenbank speichern, veröffentlichen und löschen.</p><span class="btn btn-ghost">Verwalten</span></a>
      <a class="data-card task-wide-card" href="tasks.php"><div class="card-icon">🗂️</div><h3>Aufgabenboard</h3><p class="muted">Admin-Bereich für Arbeitsaufträge: Spalten erstellen, Aufträge erfassen und Karten zwischen Status verschieben.</p><span class="btn btn-primary">Aufgaben öffnen</span></a>
    <?php endif; ?>
  </div>
  <p style="margin-top:22px"><a href="logout.php" class="btn btn-ghost">🚪 Logout</a></p>
</div></main>
<?php include 'assets/footer.php'; ?>
