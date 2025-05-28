<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>
    <nav role="navigation" aria-label="Hauptnavigation">
      <div class="nav-left">
        <img src="pic/logo.jpg" alt="Logo" height="40">
      </div>
      <ul>
        <li><a href="index.php">Startseite</a></li>
        <li><a href="bio.php">Bio</a></li>
        <li><a href="blog.php" aria-current="page">Blog</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
      </ul>
      <a href="login.php" class="login-btn" role="button" aria-label="Anmelden">Anmelden</a>
    </nav>
    <header>
        <h1>Blog</h1>
        <p>Hier findest du aktuelle Beiträge zu IT, Technik & mehr!</p>
    </header>
    <main class="container" style="max-width:1000px; margin:3rem auto; background:white; border-radius:10px; box-shadow:0 8px 20px rgb(0 0 0 / 0.08); padding:2rem;">
        <section class="blog-posts" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:2rem;">
            <article class="blog-post">
                <img src="pic/blog1.jpg" alt="JavaScript Neuheiten 2024" style="width:100%; height:170px; object-fit:cover; border-radius:8px 8px 0 0;">
                <div class="blog-post-content">
                    <h2>Neue JavaScript Funktionen 2024</h2>
                    <div class="meta">10. Mai 2024</div>
                    <p>Lerne die neuesten Features von JavaScript und wie du sie im Alltag anwendest.</p>
                    <a href="#">Weiterlesen</a>
                </div>
            </article>
            <article class="blog-post">
                <img src="pic/blog2.jpg" alt="Web-Sicherheit" style="width:100%; height:170px; object-fit:cover; border-radius:8px 8px 0 0;">
                <div class="blog-post-content">
                    <h2>Sicherheitspraktiken für Webentwickler</h2>
                    <div class="meta">28. April 2024</div>
                    <p>Wichtige Tipps, um deine Webanwendungen vor Angriffen zu schützen.</p>
                    <a href="#">Weiterlesen</a>
                </div>
            </article>
            <article class="blog-post">
                <img src="pic/blog3.jpg" alt="Cloud Infrastruktur" style="width:100%; height:170px; object-fit:cover; border-radius:8px 8px 0 0;">
                <div class="blog-post-content">
                    <h2>Cloud Infrastruktur verstehen</h2>
                    <div class="meta">15. April 2024</div>
                    <p>Grundlagen und Best Practices für eine zuverlässige Cloud-Architektur.</p>
                    <a href="#">Weiterlesen</a>
                </div>
            </article>
            <article class="blog-post">
                <img src="pic/blog4.jpg" alt="Machine Learning" style="width:100%; height:170px; object-fit:cover; border-radius:8px 8px 0 0;">
                <div class="blog-post-content">
                    <h2>Einführung in Machine Learning</h2>
                    <div class="meta">30. März 2024</div>
                    <p>Ein leichter Einstieg in die Welt des maschinellen Lernens für Entwickler.</p>
                    <a href="#">Weiterlesen</a>
                </div>
            </article>
            <article class="blog-post">
                <img src="pic/blog5.jpg" alt="Agile Methoden" style="width:100%; height:170px; object-fit:cover; border-radius:8px 8px 0 0;">
                <div class="blog-post-content">
                    <h2>Agile Methoden effektiv nutzen</h2>
                    <div class="meta">20. März 2024</div>
                    <p>Wie du Agile in deinem Team integrierst und erfolgreich Projekte leitest.</p>
                    <a href="#">Weiterlesen</a>
                </div>
            </article>
        </section>
    </main>
    <footer>
        <div>
            <a href="impressum.php" rel="noopener noreferrer">Impressum</a> |
            <a href="datenschutz.php" rel="noopener noreferrer">Datenschutz</a>
        </div>
        <div>© 2024 Alle Rechte vorbehalten.</div>
    </footer>
</body>
</html>
