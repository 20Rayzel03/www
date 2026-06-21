<?php
$pageTitle = 'Blog';
include 'assets/db.php';
$posts = [];
$result = $conn->query("SELECT id, title, summary, content, image, published_at FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC, id DESC");
if ($result) { while ($row = $result->fetch_assoc()) { $posts[] = $row; } }
include 'assets/header.php';
?>
<header class="page-hero"><div class="container"><span class="eyebrow">Artikel & Projekte</span><h1>Blog</h1><p>Hier findest du spannende Artikel rund um IT, Server & Webentwicklung.</p></div></header>
<main class="section">
  <section class="blog-posts container">
    <?php foreach ($posts as $post): ?>
      <article class="blog-post">
        <img src="<?= htmlspecialchars($post['image'] ?: 'assets/img/logo.png') ?>" alt="Beitragsbild">
        <div class="blog-post-content">
          <h2><?= htmlspecialchars($post['title']) ?></h2>
          <div class="meta"><?= htmlspecialchars(date('d. F Y', strtotime($post['published_at']))) ?></div>
          <p><?= nl2br(htmlspecialchars($post['summary'])) ?></p>
          <?php if (!empty($post['content'])): ?><a class="btn btn-ghost" href="blog_post.php?id=<?= (int)$post['id'] ?>">Weiterlesen</a><?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
    <?php if (!$posts): ?><div class="glass-card"><h2>Noch keine Beiträge</h2><p class="muted">Sobald Beiträge veröffentlicht sind, erscheinen sie hier.</p></div><?php endif; ?>
  </section>
</main>
<?php include 'assets/footer.php'; ?>
