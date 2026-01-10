<?php
$base = __DIR__;
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Startseite</title>

  <!-- Reihenfolge ist wichtig: erst Global, dann Header/Footer, dann page-spezifisch -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/css/style.css') ?>">
  <link rel="stylesheet" href="assets/css/head-foot.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/css/head-foot.css') ?>">
  <link rel="stylesheet" href="assets/css/home.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/css/home.css') ?>">
</head>

<body class="home-page">

  <?php include $base . '/assets/header.php'; ?>

  <header class="masthead">
    <div class="overlay"></div>
    <div class="content">
      <h1>JQPOLLAG.DE</h1>
      <p>Schön, dass du hier bist – entdecke mehr über mich, meine Erlebnisse und Projekte.</p>
      <a href="bio.php" class="btn btn-success">Über mich</a>
    </div>
  </header>

  <!-- Über mich -->
  <section id="about" class="py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Über mich</h2>

      <div class="home-split">
        <div class="home-split__media">
          <img src="assets/img/real_me.png" alt="Profilbild" class="section-image img-fluid">
        </div>

        <div class="home-split__content">
          <p class="lead">Ich bin ein IT-Enthusiast mit Schwerpunkt auf Servermanagement, Support und Linux/Windows-Systemen.</p>
          <p>Hier erfährst du mehr über meine Leidenschaft für Technologie und meine berufliche Reise.</p>
          <a href="bio.php" class="btn btn-success">Mehr erfahren</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Projekte -->
  <section id="projects" class="py-5 bg-light text-center">
    <div class="container">
      <h2 class="mb-4">Projekte</h2>

      <div class="home-split home-split--reverse">
        <div class="home-split__media">
          <img src="assets/img/projekt-v2.png" alt="Projekte Übersicht" class="section-image img-fluid">
        </div>

        <div class="home-split__content">
          <p class="lead">Ein Überblick über meine letzten Arbeiten und IT-Projekte.</p>
          <p>Entdecke, wie ich Server optimiert, Apps entwickelt und Systeme gesichert habe.</p>
          <a href="blog.php" class="btn btn-success">Zum Blog</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontakt -->
  <section id="contact" class="py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Kontakt</h2>

      <div class="home-split">
        <div class="home-split__media">
          <img src="assets/img/kontakt.png" alt="Kontakt Illustration" class="section-imgkontakt img-fluid">
        </div>

        <div class="home-split__content">
          <p class="lead">Du möchtest mit mir in Kontakt treten? Ich freue mich über deine Nachricht.</p>
          <p>Lass uns über IT-Themen, Projekte und weiteres sprechen.</p>
          <a href="kontakt.php" class="btn btn-success">Kontakt aufnehmen</a>
        </div>
      </div>
    </div>
  </section>

  <?php include $base . '/assets/sozial.php'; ?>
  <?php include $base . '/assets/footer.php'; ?>

</body>
</html>
