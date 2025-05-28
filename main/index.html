<?php
// Optional: Hier kannst du später PHP-Code einfügen, z.B. für Blogposts aus Datenbank.
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hauptseite - IT Themen</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <nav role="navigation" aria-label="Hauptnavigation">
    <div class="nav-left">
      <img src="pic/logo.jpg" alt="Logo" height="40">
    </div>
    <ul>
      <li><a href="index.php" aria-current="page">Startseite</a></li>
      <li><a href="bio.php">Bio</a></li>
      <li><a href="blog.php">Blog</a></li>
      <li><a href="kontakt.php">Kontakt</a></li>
    </ul>
    <a href="login.php" class="login-btn" role="button" aria-label="Anmelden">Anmelden</a>
  </nav>

  <header>
    <h1>Willkommen auf jqpollag.de</h1>
  </header>

  <section id="bio-teaser" class="container" aria-label="Kurzvorstellung">
    <img src="pic/real_me.jpg" alt="Porträtbild" />
    <div class="content">
      <h2>Über mich</h2>
      <p>Ich bin ein leidenschaftlicher IT-Enthusiast mit Fokus auf Server Management (z.B. Windows Server / Ubuntu Server), First & Second LVL Support. Erfahre mehr über mich über den Bio-Reiter.</p>
      <button onclick="location.href='bio.php'">Mehr erfahren</button>
    </div>
  </section>

  <section id="blog-posts" class="container" aria-label="Neueste Blogposts">
    <!-- Blogbeiträge werden durch JavaScript hier eingefügt -->
  </section>

  <footer>
    <div>
      <a href="impressum.php" rel="noopener noreferrer">Impressum</a> | 
      <a href="datenschutz.php" rel="noopener noreferrer">Datenschutz</a>
    </div>
    <div>© 2024 Alle Rechte vorbehalten.</div>
  </footer>

  <script>
    // Beispiel: User ist **nicht eingeloggt**
    const loggedIn = false;

    const posts = [
      {
        id: 1,
        title: "Neue JavaScript Funktionen 2024",
        excerpt: "Lerne die neuesten Features von JavaScript und wie du sie im Alltag anwendest.",
        date: "2024-05-10",
        restricted: false
      },
      {
        id: 2,
        title: "Sicherheitspraktiken für Webentwickler",
        excerpt: "Wichtige Tipps, um deine Webanwendungen vor Angriffen zu schützen.",
        date: "2024-04-28",
        restricted: true
      },
      {
        id: 3,
        title: "Cloud Infrastruktur verstehen",
        excerpt: "Grundlagen und Best Practices für eine zuverlässige Cloud-Architektur.",
        date: "2024-04-15",
        restricted: false
      },
      {
        id: 4,
        title: "Einführung in Machine Learning",
        excerpt: "Ein leichter Einstieg in die Welt des maschinellen Lernens für Entwickler.",
        date: "2024-03-30",
        restricted: true
      },
      {
        id: 5,
        title: "Agile Methoden effektiv nutzen",
        excerpt: "Wie du Agile in deinem Team integrierst und erfolgreich Projekte leitest.",
        date: "2024-03-20",
        restricted: false
      }
    ];

    function createPostCard(post) {
      const article = document.createElement('article');
      article.className = 'post-card';

      if (post.restricted && !loggedIn) {
        article.classList.add('restricted');
        article.tabIndex = 0;
        article.addEventListener('click', () => {
          alert('Bitte melde dich an, um diesen Beitrag zu lesen.');
        });
        article.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            alert('Bitte melde dich an, um diesen Beitrag zu lesen.');
          }
        });
      }

      const title = document.createElement('h3');
      title.textContent = post.title;

      const excerpt = document.createElement('p');
      excerpt.textContent = post.excerpt;

      const meta = document.createElement('div');
      meta.className = 'meta';
      meta.textContent = `Veröffentlicht am ${new Date(post.date).toLocaleDateString("de-DE")}`;

      article.appendChild(title);
      article.appendChild(excerpt);
      article.appendChild(meta);

      return article;
    }

    // Beiträge einfügen
    const container = document.getElementById('blog-posts');
    posts.forEach(post => {
      const card = createPostCard(post);
      container.appendChild(card);
    });
  </script>
</body>
</html>
