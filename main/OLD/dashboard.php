<?php
session_start();

// Nur eingeloggte User dürfen rein
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<?php include 'assets/header.php'; ?>

<header>
  <h1>Dashboard</h1>
</header>

<main class="container">
  <h2>Willkommen, <?= htmlspecialchars($_SESSION['username']); ?>! 🎉</h2>
  <p>Du bist nun eingeloggt und kannst hier die internen Bereiche verwalten.</p>

  <div style="margin-top:2rem;">
    <a href="anfragen.php" class="btn">📩 Kontaktanfragen ansehen</a>
    <a href="logout.php" class="btn" style="margin-left:1rem;">🚪 Logout</a>
  </div>
</main>

<?php include 'assets/footer.php'; ?>
