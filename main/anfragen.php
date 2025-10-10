<?php
session_start();

// Nur eingeloggte User dürfen rein
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/assets/db.php';

// Überprüfen, ob $conn existiert
if (!isset($conn) || !$conn instanceof mysqli) {
    die("❌ Datenbankverbindung fehlt oder ist ungültig. Stelle sicher, dass assets/db.php \$conn bereitstellt.");
}

// Anfragen aus DB laden (neueste zuerst)
$sql = "SELECT id, name, email, nachricht, erstellt_am FROM kontaktanfragen ORDER BY erstellt_am DESC";
$result = $conn->query($sql);

$anfragen = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $anfragen[] = $row;
    }
}
?>

<?php include 'assets/header.php'; ?>

<header>
  <h1>Kontaktanfragen</h1>
</header>

<main class="container">
  <h2>📬 Übersicht aller Anfragen</h2>
  <p>Hier kannst du alle über das Kontaktformular gesendeten Anfragen einsehen.</p>

  <div style="margin-top:1.5rem;">
    <a href="dashboard.php" class="btn">⬅️ Zurück zum Dashboard</a>
    <a href="logout.php" class="btn" style="margin-left:1rem;">🚪 Logout</a>
  </div>

  <hr style="margin:2rem 0;">

  <?php if (empty($anfragen)): ?>
    <p>Keine Anfragen vorhanden.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse: collapse; margin-top:1rem;">
      <thead>
        <tr style="background:#f5f5f5;">
          <th style="padding:8px; border:1px solid #ddd;">ID</th>
          <th style="padding:8px; border:1px solid #ddd;">Name</th>
          <th style="padding:8px; border:1px solid #ddd;">E-Mail</th>
          <th style="padding:8px; border:1px solid #ddd;">Betreff</th>
          <th style="padding:8px; border:1px solid #ddd;">Datum</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($anfragen as $a): ?>
          <tr>
            <td style="padding:8px; border:1px solid #ddd;"><?= htmlspecialchars($a['id']); ?></td>
            <td style="padding:8px; border:1px solid #ddd;"><?= htmlspecialchars($a['name']); ?></td>
            <td style="padding:8px; border:1px solid #ddd;">
              <a href="mailto:<?= htmlspecialchars($a['email']); ?>"><?= htmlspecialchars($a['email']); ?></a>
            </td>
            <td style="padding:8px; border:1px solid #ddd;"><?= nl2br(htmlspecialchars($a['nachricht'])); ?></td>
            <td style="padding:8px; border:1px solid #ddd;"><?= htmlspecialchars($a['erstellt_am']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</main>

<?php include 'assets/footer.php'; ?>
