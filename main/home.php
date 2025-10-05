<?php include 'assets/header.php'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meine Webseite</title>

  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Dein eigenes Design -->
  <link href="assets/css/home.css" rel="stylesheet">
</head>
<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
    <div class="container px-4">
      <a class="navbar-brand" href="#page-top">Meine Webseite</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menü
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#about">Über mich</a></li>
          <li class="nav-item"><a class="nav-link" href="#projects">Projekte</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead">
    <div class="overlay"></div>
    <div class="content">
      <h1>jqpollag.de</h1>
      <p>Ein modernes, minimalistisches One-Page Design</p>
      <a href="#about" class="btn btn-primary">Los geht's</a>
    </div>
  </header>

  <!-- Sektionen -->
  <section id="about" class="py-5 text-center">
    <div class="container">
      <h2>Über mich</h2>
      <p class="lead">Hier kannst du Infos über dich einfügen.</p>
    </div>
  </section>

  <section id="projects" class="py-5 bg-light text-center">
    <div class="container">
      <h2>Projekte</h2>
      <p class="lead">Liste deiner Projekte.</p>
    </div>
  </section>

  <section id="contact" class="py-5 text-center">
    <div class="container">
      <h2>Kontakt</h2>
      <p class="lead">Kontaktinformationen oder Formular.</p>
    </div>
  </section>

  <script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
