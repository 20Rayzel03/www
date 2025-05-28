<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bio</title>
    <link rel="stylesheet" href="css/bio.css">
</head>
<body>
    <nav role="navigation" aria-label="Hauptnavigation">
      <div class="nav-left">
        <img src="pic/logo.jpg" alt="Logo" height="40">
      </div>
      <ul>
        <li><a href="index.html">Startseite</a></li>
        <li><a href="bio.php" aria-current="page">Bio</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
      </ul>
      <a href="login.php" class="login-btn" role="button" aria-label="Anmelden">Anmelden</a>
    </nav>
    <header>
        <h1>Über mich</h1>
    </header>
    <main class="container" style="max-width:900px; margin:3rem auto; background:white; border-radius:10px; box-shadow:0 8px 20px rgb(0 0 0 / 0.1); padding:2rem; display:flex; flex-wrap:wrap; gap:2rem; align-items:center;">
        <div style="flex:1; min-width:240px;">
            <img src="pic/real_me.jpg" alt="Porträtbild" style="width:100%; max-width:280px; border-radius:10px; box-shadow:0 4px 16px rgb(0 0 0 / 0.09); display:block; margin:auto;">
        </div>
        <div style="flex:2; min-width:250px;">
            <h2>Hallo! Ich bin [Dein Name]</h2>
            <ul style="list-style:none; padding-left:0; margin-bottom:1.2rem;">
                <li>🎓 Ausbildung: Fachinformatiker/in Systemintegration</li>
                <li>💻 IT-Enthusiast: Servermanagement (Windows & Ubuntu Server)</li>
                <li>📞 Support-Erfahrung: First & Second Level Support</li>
                <li>🌍 Sprachen: Deutsch, Englisch</li>
                <li>🧑‍💻 Projekte: Netzwerkaufbau, Webentwicklung, Automatisierung</li>
            </ul>
            <p>Ich liebe es, IT-Probleme zu lösen, Neues zu lernen und innovative Lösungen zu bauen. In meiner Freizeit programmiere ich, experimentiere mit Servern und unterstütze Freunde und Bekannte bei technischen Fragen.</p>
            <p>Neugierig auf mehr? Schau gerne auf meinem Blog vorbei oder schreib mir direkt eine Nachricht über das Kontaktformular!</p>
        </div>
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
