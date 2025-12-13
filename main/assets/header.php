<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="./assets/img/logo.png?v=1" sizes="any">
  <link rel="icon" type="image/png?v=1" href="./assets/img/logo.png?v=1">
  <title>jqpollag.de</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/cookies.css">


  <?php
  $page = basename($_SERVER['PHP_SELF'], ".php");
  if (file_exists("assets/css/$page.css")) {
      echo '<link rel="stylesheet" href="assets/css/' . $page . '.css">';
  }
  ?>
</head>
<body>
  <nav role="navigation" aria-label="Hauptnavigation">
    <div class="nav-left">
      <img src="./assets/img/logo.png" alt="Logo" height="40">
    </div>
    <ul class="nav-center">
      <li><a href="home.php">Startseite</a></li>
      <li><a href="bio.php">Bio</a></li>
      <li><a href="blog.php">Blog</a></li>
      <li><a href="kontakt.php">Kontakt</a></li>
    </ul>
    <!-- <a href="login.php" class="login-btn" role="button">Login</a> -->
  </nav>
