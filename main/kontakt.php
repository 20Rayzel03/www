<?php include 'assets/header.php'; ?>
<?php include 'db.php'; ?>

<header>
  <h1>Kontakt</h1>
  <p>Schreibe mir gerne eine Nachricht über das Formular.</p>
</header>

<main>
  <section class="container">
    <?php
    $success = false;
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);

        if ($name && $email && $message) {
            $stmt = $conn->prepare("INSERT INTO kontaktanfragen (name, email, nachricht) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);

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

    <?php if ($success): ?>
      <div style="padding:1rem; background:#e6ffed; border:1px solid #4caf50; border-radius:8px; margin-bottom:1rem;">
        ✅ Vielen Dank für deine Nachricht! Ich melde mich bald bei dir.
      </div>
    <?php elseif ($error): ?>
      <div style="padding:1rem; background:#ffe6e6; border:1px solid #f44336; border-radius:8px; margin-bottom:1rem;">
        ❌ <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form class="contact-form" action="kontakt.php" method="post">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">E-Mail</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Nachricht</label>
      <textarea id="message" name="message" rows="6" required></textarea>

      <button type="submit">Absenden</button>
    </form>
  </section>
</main>

<?php include 'assets/footer.php'; ?>
