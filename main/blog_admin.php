<?php
require_once __DIR__ . '/assets/auth.php';
require_admin();
include 'assets/db.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];
    $stmt = $conn->prepare('DELETE FROM blog_posts WHERE id = ?');
    $stmt->bind_param('i', $id); $stmt->execute(); $message = 'Beitrag gelöscht.';
  } else {
    $title = trim($_POST['title'] ?? ''); $summary = trim($_POST['summary'] ?? ''); $content = trim($_POST['content'] ?? ''); $image = trim($_POST['image'] ?? 'assets/img/logo.png'); $status = $_POST['status'] === 'draft' ? 'draft' : 'published';
    if ($title && $summary) { $stmt = $conn->prepare('INSERT INTO blog_posts (title, summary, content, image, status, author_id, published_at) VALUES (?, ?, ?, ?, ?, ?, NOW())'); $uid=(int)$_SESSION['user_id']; $stmt->bind_param('sssssi', $title, $summary, $content, $image, $status, $uid); $stmt->execute(); $message = 'Beitrag gespeichert.'; }
    else { $message = 'Titel und Kurztext sind Pflicht.'; }
  }
}
$posts = $conn->query('SELECT id,title,status,published_at FROM blog_posts ORDER BY id DESC');
$pageTitle = 'Blog verwalten'; include 'assets/header.php';
?>
<header class="page-hero"><div class="container"><span class="eyebrow">Admin</span><h1>Blog verwalten</h1><p>Hier kannst du Blogbeiträge in MariaDB speichern. Veröffentlichung erfolgt direkt auf der Blog-Seite.</p></div></header>
<main class="section"><div class="container grid grid-2">
  <section class="glass-card">
    <h2>Neuer Beitrag</h2>
    <?php if ($message): ?><div class="alert ok"><?= htmlspecialchars($message) ?></div><?php endif; ?>
    <form method="post" class="admin-form">
      <div><label>Titel</label><input name="title" required></div>
      <div><label>Kurztext</label><textarea name="summary" required></textarea></div>
      <div><label>Inhalt</label><textarea name="content"></textarea></div>
      <div><label>Bildpfad</label><input name="image" value="assets/img/logo.png"></div>
      <div><label>Status</label><select name="status"><option value="published">Veröffentlicht</option><option value="draft">Entwurf</option></select></div>
      <button class="btn btn-primary" type="submit">Beitrag speichern</button>
    </form>
  </section>
  <section class="glass-card">
    <h2>Gespeicherte Beiträge</h2>
    <div class="table-wrap"><table><thead><tr><th>Titel</th><th>Status</th><th>Datum</th><th></th></tr></thead><tbody>
      <?php while($p = $posts->fetch_assoc()): ?><tr><td><?= htmlspecialchars($p['title']) ?></td><td><span class="status-badge"><?= htmlspecialchars($p['status']) ?></span></td><td><?= htmlspecialchars($p['published_at']) ?></td><td><form method="post" onsubmit="return confirm('Beitrag löschen?')"><input type="hidden" name="delete_id" value="<?= (int)$p['id'] ?>"><button class="btn btn-ghost" type="submit">Löschen</button></form></td></tr><?php endwhile; ?>
    </tbody></table></div>
    <p style="margin-top:16px"><a href="dashboard.php" class="btn btn-ghost">← Zurück zum Dashboard</a></p>
  </section>
</div></main>
<?php include 'assets/footer.php'; ?>
