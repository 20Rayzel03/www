<?php include 'assets/header.php'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Startseite | Meine Webseite</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- Bootstrap Icons (für Icons in den Abschnitten) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

  <!-- Hauptdesign -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Seitenspezifisches CSS -->
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="assets/css/home2.css">
  
</head>

<body>

  <!-- Masthead / Hero Section (unverändert) -->
  <header class="masthead">
    <div class="overlay"></div>
    <div class="content">
      <h1>Willkommen auf JQPOLLAG.DE</h1>
      <p>Schön, dass du hier bist – entdecke mehr über mich, meine Erlebnisse und Projekte.</p>
      <a href="bio.php" class="btn btn-primary">Über mich</a>
    </div>
  </header>

  <!-- Über mich (neu gestaltet mit Bild) -->
  <section id="about" class="py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Über mich</h2>
      <div class="row section-row justify-content-center">
        <div class="col-md-4 mb-3">
          <img src="assets/img/real_me.png" alt="Profilbild" class="section-image img-fluid">
        </div>
        <div class="col-md-8 section-content">
          <p class="lead">Ich bin ein IT-Enthusiast mit Schwerpunkt auf Servermanagement, Support und Linux/Windows-Systemen. <i class="bi bi-person-circle text-primary"></i></p>
          <p>Hier erfährst du mehr über meine Leidenschaft für Technologie und meine berufliche Reise.</p>
          <a href="bio.php" class="btn btn-outline-secondary mt-3">Mehr erfahren</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Projekte (neu gestaltet mit Bild) -->
  <section id="projects" class="py-5 bg-light text-center">
    <div class="container">
      <h2 class="mb-4">Projekte</h2>
      <div class="row section-row justify-content-center">
        <div class="col-md-4 mb-3 order-md-2">
          <img src="assets/img/projekt-v2.png" alt="Projekte Übersicht" class="section-image img-fluid">
        </div>
        <div class="col-md-8 section-content order-md-1">
          <p class="lead">Ein Überblick über meine letzten Arbeiten und IT-Projekte. <i class="bi bi-code-slash text-success"></i></p>
          <p>Entdecke, wie ich Server optimiert, Apps entwickelt und Systeme gesichert habe.</p>
          <a href="blog.php" class="btn btn-outline-primary mt-3">Zum Blog</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontakt (neu gestaltet mit Bild/Icon) -->
  <section id="contact" class="py-5 text-center">
    <div class="container">
      <h2 class="mb-4">Kontakt</h2>
      <div class="row section-row justify-content-center">
        <div class="col-md-4 mb-3">
          <img src="assets/img/kontakt.png" alt="Kontakt Illustration" class="section-imgkontakt img-fluid">
          <!-- Alternativ: Ein Icon statt Bild, falls kein Bild verfügbar -->
          <!-- <i class="bi bi-envelope-heart display-1 text-success mb-3"></i> -->
        </div>
        <div class="col-md-8 section-content">
          <p class="lead">Du möchtest mit mir in Kontakt treten? Ich freue mich über deine Nachricht. <i class="bi bi-chat-dots text-info"></i></p>
          <p>Lass uns über IT-Themen, Projekte und weiters sprechen.</p>
          <a href="kontakt.php" class="btn btn-success mt-3">Kontakt aufnehmen</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Sozial Media -->
  <!-- ?php include 'assets/sozial.php'; ?> -->

  <!-- Footer -->
  <?php include 'assets/footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
