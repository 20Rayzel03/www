<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>jqpollag.de</title>
  <link rel="stylesheet" href="/assets/css/style.css">

  <?php
  // Prüfen, welche Seite geladen ist, und optional extra CSS einfügen
  $page = basename($_SERVER['PHP_SELF'], ".php");
  if (file_exists("assets/css/$page.css")) {
      echo '<link rel="stylesheet" href="assets/css/' . $page . '.css">';
  }
  ?>
</head>
<body>
  <nav role="navigation" aria-label="Hauptnavigation">
    <div class="nav-left">
      <img src="/assets/img/logo.webp" alt="Logo" height="40">
    </div>
    <ul>
      <li><a href="home.php">Startseite</a></li>
      <li><a href="bio.php">Bio</a></li>
      <li><a href="blog.php">Blog</a></li>
      <li><a href="kontakt.php">Kontakt</a></li>
    </ul>
    <a href="login.php" class="login-btn" role="button">Anmelden</a>
  </nav>
