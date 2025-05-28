<?php
// ------ Einstellungen ------
$empfaenger = "julius.pollag@jqpollag.de"; // HIER DEINE EIGENE E-MAIL EINTRAGEN!
$betreff_standard = "Neue Kontaktanfrage von deiner Webseite";

// ------ Formular gesendet? ------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Felder auslesen und filtern
    $name     = trim($_POST["name"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $betreff  = trim($_POST["betreff"] ?? "");
    $nachricht = trim($_POST["nachricht"] ?? "");

    // Validierung
    $fehler = [];
    if ($name === "")        $fehler[] = "Bitte gib deinen Namen an.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $fehler[] = "Bitte gib eine gültige E-Mail-Adresse an.";
    if ($betreff === "")     $fehler[] = "Bitte gib einen Betreff an.";
    if ($nachricht === "")   $fehler[] = "Bitte gib eine Nachricht ein.";

    if (empty($fehler)) {
        // E-Mail zusammenbauen
        $mailBetreff = "[$betreff_standard] $betreff";
        $mailText = "Neue Nachricht über das Kontaktformular:\n\n"
            . "Name: $name\n"
            . "E-Mail: $email\n"
            . "Betreff: $betreff\n\n"
            . "Nachricht:\n$nachricht\n";

        $header = "From: $name <$email>\r\nReply-To: $email";

        // Senden
        $mailGesendet = mail($empfaenger, $mailBetreff, $mailText, $header);

        if ($mailGesendet) {
            $info = "Vielen Dank für deine Nachricht! Ich melde mich so schnell wie möglich.";
        } else {
            $info = "Es ist ein Fehler beim Senden der Nachricht aufgetreten. Bitte versuche es später erneut.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontakt - jqpollag.de</title>
    <link rel="stylesheet" href="css/kontakt.css" />
</head>
<body>
    <nav role="navigation" aria-label="Hauptnavigation">
        <div class="nav-left">
            <img src="pic/logo.jpg" alt="Logo" height="40">
        </div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="bio.php">Bio</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="kontakt.php" aria-current="page">Kontakt</a></li>
        </ul>
        <a href="login.php" class="login-btn" role="button" aria-label="Anmelden">Anmelden</a>
    </nav>

    <header>
        <h1>Kontaktiere mich</h1>
        <p>Du hast Fragen, Feedback oder möchtest einfach Hallo sagen? Schreib mir gerne über das Kontaktformular.</p>
    </header>

    <main>
        <section class="container" style="max-width:600px; margin-top: 2.5rem; margin-bottom: 2.5rem;">
            <?php if (!empty($fehler)): ?>
                <div style="background:#f8d7da; color:#721c24; padding:1rem; border-radius:6px; margin-bottom:1rem;">
                    <ul style="margin:0;padding-left:1.1rem;">
                        <?php foreach ($fehler as $f): ?>
                            <li><?= htmlspecialchars($f) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif (isset($info)): ?>
                <div style="background:#d4edda; color:#155724; padding:1rem; border-radius:6px; margin-bottom:1rem;">
                    <?= htmlspecialchars($info) ?>
                </div>
            <?php endif; ?>

            <form action="kontakt.php" method="post" class="contact-form" autocomplete="off">
                <div style="display: flex; flex-direction: column; gap: 1.2rem;">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required placeholder="Dein Name" value="<?= htmlspecialchars($name ?? "") ?>" />
                    </div>
                    <div>
                        <label for="email">E-Mail</label>
                        <input type="email" id="email" name="email" required placeholder="dein@email.de" value="<?= htmlspecialchars($email ?? "") ?>" />
                    </div>
                    <div>
                        <label for="betreff">Betreff</label>
                        <input type="text" id="betreff" name="betreff" required placeholder="Worum geht's?" value="<?= htmlspecialchars($betreff ?? "") ?>" />
                    </div>
                    <div>
                        <label for="nachricht">Nachricht</label>
                        <textarea id="nachricht" name="nachricht" rows="6" required placeholder="Deine Nachricht"><?= htmlspecialchars($nachricht ?? "") ?></textarea>
                    </div>
                    <button type="submit">Absenden</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <div>
            <a href="impressum.php" rel="noopener noreferrer">Impressum</a> |
            <a href="datenschutz.php" rel="noopener noreferrer">Datenschutz</a>
        </div>
        <div>© 2025 Alle Rechte vorbehalten.</div>
    </footer>
</body>
</html>

