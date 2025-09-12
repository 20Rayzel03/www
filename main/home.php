<?php include 'assets/header.php'; ?>

<header>
  <h1>Willkommen auf jqpollag.de</h1>
</header>

<main>
  <!-- Bio-Teaser -->
  <section id="bio-teaser" class="container">
    <div class="bio-image">
      <img src="assets/img/real_me.png" alt="Porträtbild">
    </div>
    <div class="content">
      <h2>Über mich</h2>
      <p>
        Ich bin ein leidenschaftlicher IT-Enthusiast mit Fokus auf Server Management
        (z.B. Windows Server / Ubuntu Server) sowie First & Second Level Support.
        Erfahre mehr über mich im Bio-Bereich.
      </p>
      <a href="bio.php" class="btn">Mehr erfahren</a>
    </div>
  </section>

  <!-- Blog-Posts (Platzhalter) -->
  <section id="blog-posts" class="container" aria-label="Neueste Blogposts">
    <article class="post-card">
      <h3>Neue JavaScript Funktionen 2024</h3>
      <p>Lerne die neuesten Features von JavaScript und wie du sie im Alltag anwendest.</p>
      <div class="meta">Veröffentlicht am 10.05.2024</div>
    </article>

    <article class="post-card restricted">
      <h3>Sicherheitspraktiken für Webentwickler</h3>
      <p>Wichtige Tipps, um deine Webanwendungen vor Angriffen zu schützen.</p>
      <div class="meta">Veröffentlicht am 28.04.2024</div>
    </article>

    <article class="post-card">
      <h3>Cloud Infrastruktur verstehen</h3>
      <p>Grundlagen und Best Practices für eine zuverlässige Cloud-Architektur.</p>
      <div class="meta">Veröffentlicht am 15.04.2024</div>
    </article>
  </section>
</main>

<?php include 'assets/footer.php'; ?>
