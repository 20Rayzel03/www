<?php include 'assets/header.php'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Startseite | Meine Webseite</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Hauptdesign -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Seitenspezifisches CSS -->
  <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>

  <!-- Masthead / Hero Section -->
  <header class="masthead">
    <div class="overlay"></div>
    <div class="content">
      <h1>Willkommen!</h1>
      <p>Schön, dass du hier bist – entdecke mehr über mich und meine Projekte.</p>
      <a href="bio.php" class="btn btn-primary">Über mich</a>
    </div>
  </header>

  <!-- Über mich -->
  <section id="about" class="py-5 text-center">
    <div class="container">
      <h2>Über mich</h2>
      <p class="lead">Ich bin ein IT-Enthusiast mit Schwerpunkt auf Servermanagement, Support und Linux/Windows-Systemen.</p>
      <a href="bio.php" class="btn btn-outline-secondary mt-3">Mehr erfahren</a>
    </div>
  </section>

  <!-- Projekte -->
  <section id="projects" class="py-5 bg-light text-center">
    <div class="container">
      <h2>Projekte</h2>
      <p class="lead">Ein Überblick über meine letzten Arbeiten und IT-Projekte.</p>
      <a href="blog.php" class="btn btn-outline-primary mt-3">Zum Blog</a>
    </div>
  </section>

  <!-- Kontakt -->
  <section id="contact" class="py-5 text-center">
    <div class="container">
      <h2>Kontakt</h2>
      <p class="lead">Du möchtest mit mir in Kontakt treten? Ich freue mich über deine Nachricht.</p>
      <a href="kontakt.php" class="btn btn-success mt-3">Kontakt aufnehmen</a>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'assets/footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
