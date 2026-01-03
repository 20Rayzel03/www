<?php
$current = basename($_SERVER['PHP_SELF']);

function navActive($file, $current){
  return $file === $current ? 'active' : '';
}
?>

<nav class="main-nav" role="navigation" aria-label="Hauptnavigation">
  <div class="nav-left">
    <img src="./assets/img/logo.png" alt="Logo" height="40">
  </div>

  <ul class="nav-center">
    <li><a href="home.php" class="<?= navActive('home.php', $current) ?>">Startseite</a></li>
    <li><a href="bio.php" class="<?= navActive('bio.php', $current) ?>">Bio</a></li>
    <li><a href="blog.php" class="<?= navActive('blog.php', $current) ?>">Blog</a></li>
    <li><a href="kontakt.php" class="<?= navActive('kontakt.php', $current) ?>">Kontakt</a></li>
  </ul>
</nav>