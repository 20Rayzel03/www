<?php $pageTitle = 'Startseite'; include 'assets/header.php'; ?>
<header class="hero">
  <div class="container hero-grid">
    <div>
      <span class="eyebrow">Homelab · IT · Projekte</span>
      <h1>JQPOLLAG.DE</h1>
      <p class="lead">Schön, dass du hier bist – entdecke mehr über mich, meine Erlebnisse und Projekte.</p>
      <div class="hero-actions">
        <a href="bio.php" class="btn btn-primary">Über mich</a>
        <a href="blog.php" class="btn btn-ghost">Zum Blog</a>
      </div>
    </div>
    <div class="hero-card">
      <img src="assets/img/hero-bg.jpg" alt="JQPOLLAG.DE Hintergrund">
      <div class="stat-row">
        <div class="stat"><strong>IT</strong><span>Server & Support</span></div>
        <div class="stat"><strong>Lab</strong><span>Homelab</span></div>
        <div class="stat"><strong>Blog</strong><span>Projekte</span></div>
      </div>
    </div>
  </div>
</header>
<section id="about" class="section">
  <div class="container split">
    <div class="split-media"><img src="assets/img/real_me.png" alt="Profilbild"></div>
    <div class="content-panel">
      <span class="pill">Über mich</span>
      <h2>Über mich</h2>
      <p class="lead">Ich bin ein IT-Enthusiast mit Schwerpunkt auf Servermanagement, Support und Linux/Windows-Systemen.</p>
      <p class="muted">Hier erfährst du mehr über meine Leidenschaft für Technologie und meine berufliche Reise.</p>
      <a href="bio.php" class="btn btn-primary">Mehr erfahren</a>
    </div>
  </div>
</section>
<section id="projects" class="section">
  <div class="container split reverse">
    <div class="content-panel">
      <span class="pill">Projekte</span>
      <h2>Projekte</h2>
      <p class="lead">Ein Überblick über meine letzten Arbeiten und IT-Projekte.</p>
      <p class="muted">Entdecke, wie ich Server optimiert, Apps entwickelt und Systeme gesichert habe.</p>
      <a href="blog.php" class="btn btn-primary">Zum Blog</a>
    </div>
    <div class="split-media"><img src="assets/img/projekt-v2.png" alt="Projekte Übersicht"></div>
  </div>
</section>
<section id="contact" class="section">
  <div class="container split">
    <div class="contact-visual" aria-label="Kontakt Vorschau">
      <div class="message-card">
        <div class="message-top"><span class="message-dot"></span><strong>Neue Nachricht</strong></div>
        <div class="message-lines"><span></span><span></span><span></span></div>
      </div>
      <div class="message-badge">Antwort folgt ✨</div>
    </div>
    <div class="content-panel">
      <span class="pill">Kontakt</span>
      <h2>Kontakt</h2>
      <p class="lead">Du möchtest mit mir in Kontakt treten? Ich freue mich über deine Nachricht.</p>
      <p class="muted">Lass uns über IT-Themen, Projekte und weiteres sprechen.</p>
      <a href="kontakt.php" class="btn btn-primary">Kontakt aufnehmen</a>
    </div>
  </div>
</section>
<?php include 'assets/sozial.php'; ?>
<?php include 'assets/footer.php'; ?>
