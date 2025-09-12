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
  <p>Willkommen, <?= htmlspecialchars($_SESSION['username']); ?>! 🎉</p>
  <p>Hier kannst du deine Admin-Bereiche verwalten.</p>

  <a href="anfragen.php" class="btn">Kontaktanfragen ansehen</a>
  <br><br>
  <a href="logout.php" class="btn">Logout</a>
</main>

<?php include 'assets/footer.php'; ?>
