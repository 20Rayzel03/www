<?php
include 'assets/db.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT title, summary, content, image, published_at FROM blog_posts WHERE id = ? AND status = 'published' LIMIT 1");
$stmt->bind_param('i', $id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
if (!$post) { http_response_code(404); $pageTitle = 'Beitrag nicht gefunden'; include 'assets/header.php'; echo '<main class="section"><div class="container glass-card"><h1>Beitrag nicht gefunden</h1><a class="btn" href="blog.php">Zurück zum Blog</a></div></main>'; include 'assets/footer.php'; exit; }
$pageTitle = $post['title'];
include 'assets/header.php';
?>
<header class="page-hero"><div class="container"><span class="eyebrow">Blogbeitrag</span><h1><?= htmlspecialchars($post['title']) ?></h1><p><?= htmlspecialchars($post['summary']) ?></p><div class="meta"><?= htmlspecialchars(date('d. F Y', strtotime($post['published_at']))) ?></div></div></header>
<main class="section"><article class="container content-panel bio-copy"><?php if ($post['image']): ?><img src="<?= htmlspecialchars($post['image']) ?>" alt="Beitragsbild" style="border-radius:18px;margin-bottom:24px"><?php endif; ?><?= nl2br(htmlspecialchars($post['content'])) ?><p style="margin-top:28px"><a class="btn btn-ghost" href="blog.php">← Zurück zum Blog</a></p></article></main>
<?php include 'assets/footer.php'; ?>
