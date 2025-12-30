<?php
// assets/footer.php
?>
<footer class="site-footer">
  <div class="footer-links">
    <a href="impressum.php">Impressum</a> |
    <a href="datenschutz.php">Datenschutz</a>
  </div>

  <div class="footer-copy">
    © <?= date("Y") ?> Alle Rechte vorbehalten.
  </div>
</footer>

<!-- Cookie-Hinweis -->
<div id="cookie-banner" class="cookie-banner" hidden>
  <p>
    Diese Website verwendet Cookies, um dir das bestmögliche Erlebnis zu bieten.
    <a href="datenschutz.php">Mehr erfahren</a>
  </p>
  <button id="cookie-accept">OK</button>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const banner = document.getElementById("cookie-banner");
  const acceptBtn = document.getElementById("cookie-accept");

  if (!localStorage.getItem("cookieAccepted")) {
    banner.hidden = false;
  }

  acceptBtn.addEventListener("click", function () {
    localStorage.setItem("cookieAccepted", "true");
    banner.hidden = true;
  });
});
</script>
