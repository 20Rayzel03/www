<?php
require_once __DIR__ . '/assets/auth.php';
require_admin();
require_once __DIR__ . '/assets/db.php';
$result = $conn->query("SELECT id, COALESCE(NULLIF(name,''), TRIM(CONCAT(COALESCE(fname,''),' ',COALESCE(lname,'')))) AS name, email, COALESCE(subject,'') AS subject, COALESCE(nachricht,message,'') AS nachricht, erstellt_am FROM kontaktanfragen ORDER BY erstellt_am DESC");
$pageTitle = 'Kontaktanfragen'; include 'assets/header.php';
?>
<header class="page-hero"><div class="container"><span class="eyebrow">Admin</span><h1>Kontaktanfragen</h1><p>Hier kannst du alle über das Kontaktformular gesendeten Anfragen einsehen.</p></div></header>
<main class="section"><div class="container glass-card">
  <p><a href="dashboard.php" class="btn btn-ghost">⬅️ Zurück zum Dashboard</a> <a href="logout.php" class="btn btn-ghost">🚪 Logout</a></p>
  <div class="table-wrap"><table><thead><tr><th>ID</th><th>Name</th><th>E-Mail</th><th>Betreff</th><th>Nachricht</th><th>Datum</th></tr></thead><tbody>
  <?php if ($result && $result->num_rows): while ($a = $result->fetch_assoc()): ?><tr><td><?= (int)$a['id'] ?></td><td><?= htmlspecialchars($a['name']) ?></td><td><a href="mailto:<?= htmlspecialchars($a['email']) ?>"><?= htmlspecialchars($a['email']) ?></a></td><td><?= htmlspecialchars($a['subject']) ?></td><td><?= nl2br(htmlspecialchars($a['nachricht'])) ?></td><td><?= htmlspecialchars($a['erstellt_am']) ?></td></tr><?php endwhile; else: ?><tr><td colspan="6">Keine Anfragen vorhanden.</td></tr><?php endif; ?>
  </tbody></table></div>
</div></main>
<?php include 'assets/footer.php'; ?>
