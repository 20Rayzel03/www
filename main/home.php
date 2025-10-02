<?php include 'assets/header.php'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meine Webseite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    /* Masthead */
    header.masthead {
      position: relative;
      width: 100%;
      height: 100vh;
      background: url('assets/img/bg-masthead.jpg') no-repeat center center;
      background-size: cover;
    }

    header.masthead .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    header.masthead .content {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      height: 100%;
      color: white;
      text-align: center;
    }

    header.masthead h1 {
      font-size: 4rem;
      font-weight: 700;
      letter-spacing: 0.2rem;
      text-transform: uppercase;
    }

    header.masthead p {
      font-size: 1.25rem;
      margin-top: 1rem;
      margin-bottom: 2rem;
    }

    .btn-custom {
      background-color: #64a19d;
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .btn-custom:hover {
      background-color: #4d7d7a;
      color: white;
    }

    /* Navbar */
    .navbar-dark .navbar-nav .nav-link {
      color: rgba(255,255,255,.8);
    }
    .navbar-dark .navbar-nav .nav-link:hover {
      color: #fff;
    }
  </style>
</head>
<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
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
      <h1>Grayscale</h1>
      <p>Ein modernes, minimalistisches One-Page Design</p>
      <a href="#about" class="btn-custom">Los geht's</a>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
