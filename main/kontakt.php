<?php
include 'assets/header.php';
include 'assets/db.php';

$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname   = trim($_POST["first-name"] ?? "");
    $lname   = trim($_POST["last-name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $subject = trim($_POST["message-subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($fname && $lname && $email && $subject && $message) {
        $stmt = $conn->prepare("INSERT INTO kontaktanfragen (fname, lname, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fname, $lname, $email, $subject, $message);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Fehler beim Speichern: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Bitte alle Felder ausfüllen.";
    }
}
?>

<link rel="stylesheet" href="/assets/css/head-foot.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/css/head-foot.css') ?>">
<link rel="stylesheet" href="/assets/css/kontakt.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT'].'/assets/css/kontakt.css') ?>">


<main>
  <section class="contact-wrap">

    <?php if ($success): ?>
      <p style="padding:10px;background:#d4edda;border:1px solid #89be95ff;">
        Nachricht wurde gesendet ✅
      </p>
    <?php elseif ($error): ?>
      <p style="padding:10px;background:#d62837;border:1px solid #ff0019ff;">
        <?= htmlspecialchars($error) ?>
      </p>
    <?php endif; ?>

    <h1>Nimm mit mir Kontakt auf
      <small>Gib mir etwas Zeit zu antworten</small>
    </h1>

    <form action="" method="post" class="contact-form">
      <div class="col-sm-6">
        <div class="input-block">
          <label for="first-name">First Name</label>
          <input id="first-name" name="first-name" type="text" class="form-control" value="<?= htmlspecialchars($_POST["first-name"] ?? "") ?>">
        </div>
      </div>

      <div class="col-sm-6">
        <div class="input-block">
          <label for="last-name">Last Name</label>
          <input id="last-name" name="last-name" type="text" class="form-control" value="<?= htmlspecialchars($_POST["last-name"] ?? "") ?>">
        </div>
      </div>

      <div class="col-sm-12">
        <div class="input-block">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" class="form-control" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        </div>
      </div>

      <div class="col-sm-12">
        <div class="input-block">
          <label for="message-subject">Message Subject</label>
          <input id="message-subject" name="message-subject" type="text" class="form-control" value="<?= htmlspecialchars($_POST["message-subject"] ?? "") ?>">
        </div>
      </div>

      <div class="col-sm-12">
        <div class="input-block textarea">
          <label for="message">Drop your message here</label>
          <textarea id="message" name="message" rows="3" class="form-control"><?= htmlspecialchars($_POST["message"] ?? "") ?></textarea>
        </div>
      </div>

      <div class="col-sm-12">
        <button type="submit" class="square-button">Send</button>
      </div>
    </form>
  </section>

  <div class="made-with-love">
    <p>Dass ich die Nachrichten lesen werde, ist nicht garantiert.</p>
  </div>
</main>

<script src="assets/js/kontakt.js"></script>

<?php include 'assets/footer.php'; ?>
