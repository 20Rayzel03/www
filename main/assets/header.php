<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$current = basename($_SERVER['PHP_SELF']);
function navActive($file, $current){ return $file === $current ? 'active' : ''; }
$pageTitle = $pageTitle ?? 'JQPOLLAG.DE';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?> | JQPOLLAG.DE</title>
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/css/style.css') ?>">
</head>
<body>
<nav class="main-nav" role="navigation" aria-label="Hauptnavigation">
  <a class="brand" href="home.php" aria-label="Zur Startseite">
    <img src="assets/img/logo.png" alt="Logo">
    <span>JQPOLLAG.DE</span>
  </a>
  <ul class="nav-center">
    <li><a href="home.php" class="<?= navActive('home.php', $current) ?>">Startseite</a></li>
    <li><a href="bio.php" class="<?= navActive('bio.php', $current) ?>">Bio</a></li>
    <li><a href="blog.php" class="<?= navActive('blog.php', $current) ?>">Blog</a></li>
    <li><a href="kontakt.php" class="<?= navActive('kontakt.php', $current) ?>">Kontakt</a></li>
  </ul>
  <div class="nav-actions">
    <?php if (!empty($_SESSION['user_id'])): ?>
      <a class="btn btn-ghost" href="dashboard.php">Dashboard</a>
      <a class="btn btn-primary" href="logout.php">Logout</a>
    <?php else: ?>
      <a class="btn btn-primary" href="login.php">Login</a>
    <?php endif; ?>
  </div>
</nav>
