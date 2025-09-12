<?php include 'assets/header.php'; ?>

<header>
  <h1>Blog</h1>
  <p>Hier findest du spannende Artikel rund um IT, Server & Webentwicklung.</p>
</header>

<main>
  <section class="blog-posts container">
    <article class="blog-post">
      <img src="assets/img/logo.webp" alt="Beispielbild">
      <div class="blog-post-content">
        <h2>Neue JavaScript Funktionen 2024</h2>
        <div class="meta">10. Mai 2024</div>
        <p>
          Lerne die neuesten Features von JavaScript kennen und wie du sie in Projekten einsetzen kannst.
        </p>
        <a href="#">Weiterlesen</a>
      </div>
    </article>

    <article class="blog-post restricted">
      <img src="assets/img/logo.webp" alt="Beispielbild">
      <div class="blog-post-content">
        <h2>Sicherheitspraktiken für Webentwickler</h2>
        <div class="meta">28. April 2024</div>
        <p>
          Wichtige Tipps, um deine Webanwendungen vor Angriffen zu schützen.
        </p>
        <a href="login.php">🔒 Anmeldung erforderlich</a>
      </div>
    </article>

    <article class="blog-post">
      <img src="assets/img/logo.webp" alt="Beispielbild">
      <div class="blog-post-content">
        <h2>Cloud Infrastruktur verstehen</h2>
        <div class="meta">15. April 2024</div>
        <p>
          Grundlagen und Best Practices für eine zuverlässige Cloud-Architektur.
        </p>
        <a href="#">Weiterlesen</a>
      </div>
    </article>
  </section>
</main>

<?php include 'assets/footer.php'; ?>
