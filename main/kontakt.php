<?php
$pageTitle = 'Kontakt';
include 'assets/db.php';
$success = false; $error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = trim($_POST["first-name"] ?? "");
    $lname = trim($_POST["last-name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = trim($_POST["message-subject"] ?? "");
    $message = trim($_POST["message"] ?? "");
    if ($fname && $lname && $email && $subject && $message) {
        $stmt = $conn->prepare("INSERT INTO kontaktanfragen (fname, lname, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fname, $lname, $email, $subject, $message);
        $success = $stmt->execute();
        if (!$success) $error = "Fehler beim Speichern: " . $stmt->error;
        $stmt->close();
    } else { $error = "Bitte alle Felder ausfüllen."; }
}
include 'assets/header.php';
?>
<header class="page-hero"><div class="container"><span class="eyebrow">Kontakt</span><h1>Nimm mit mir Kontakt auf</h1><p>Gib mir etwas Zeit zu antworten</p></div></header>
<main class="section"><div class="container contact-layout">
  <aside class="glass-card"><h2>Kontakt</h2><p class="lead">Du möchtest mit mir in Kontakt treten? Ich freue mich über deine Nachricht.</p><p class="muted">Lass uns über IT-Themen, Projekte und weiteres sprechen.</p><p class="muted">Dass ich die Nachrichten lesen werde, ist nicht garantiert.</p></aside>
  <section class="contact-wrap">
    <?php if ($success): ?><div class="alert ok">Nachricht wurde gesendet ✅</div><?php elseif ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form action="" method="post" class="contact-form">
      <div><label for="first-name">First Name</label><input id="first-name" name="first-name" type="text" class="form-control" value="<?= htmlspecialchars($_POST["first-name"] ?? "") ?>"></div>
      <div><label for="last-name">Last Name</label><input id="last-name" name="last-name" type="text" class="form-control" value="<?= htmlspecialchars($_POST["last-name"] ?? "") ?>"></div>
      <div class="col-sm-12"><label for="email">Email</label><input id="email" name="email" type="email" class="form-control" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"></div>
      <div class="col-sm-12"><label for="message-subject">Message Subject</label><input id="message-subject" name="message-subject" type="text" class="form-control" value="<?= htmlspecialchars($_POST["message-subject"] ?? "") ?>"></div>
      <div class="col-sm-12"><label for="message">Drop your message here</label><textarea id="message" name="message" rows="5" class="form-control"><?= htmlspecialchars($_POST["message"] ?? "") ?></textarea></div>
      <div class="col-sm-12"><button type="submit" class="square-button btn-primary">Send</button></div>
    </form>
  </section>
</div></main>
<script src="assets/js/kontakt.js"></script>
<?php include 'assets/footer.php'; ?>
