<?php
include 'assets/header.php';
include 'assets/db.php';

$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = trim($_POST["first-name"]);
    $lname = trim($_POST["last-name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message-subject"]);

    if ($fname && $lname && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO kontaktanfragen (fname, lname, email, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sss", $$fname, $lname, $email, $message);

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

<header>  
  <link rel="stylesheet" href="assets/css/kontakt.scss">

  <h1> Nim mit mir Kontakt auf
  <small>Gib mir etwas zeit zu antworten</small>
</h1>
</header>

<main>
<section class="contact-wrap">
  <form action="" class="contact-form">
    <div class="col-sm-6">
      <div class="input-block">
        <label for="">First Name</label>
        <input type="text" class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="input-block">
        <label for="">Last Name</label>
        <input type="text" class="form-control">
      </div>
    </div>
    <div class="col-sm-12">
      <div class="input-block">
        <label for="">Email</label>
        <input type="text" class="form-control">
      </div>
    </div>
    <div class="col-sm-12">
      <div class="input-block">
        <label for="">Message Subject</label>
        <input type="text" class="form-control">
      </div>
    </div>
    <div class="col-sm-12">
      <div class="input-block textarea">
        <label for="">Drop your message here</label>
        <textarea rows="3" type="text" class="form-control"></textarea>
      </div>
    </div>
    <div class="col-sm-12">
      <button class="square-button">Send</button>
    </div>
  </form>
</section>

<!-- follow me template -->
<div class="made-with-love">
    <p>Das ich die nachtichten lesen werde, ist nicht garantiert.</p>
  </div>
</main>

<script src="assets/js/kontakt.js"></script>
<?php include 'assets/footer.php'; ?>
