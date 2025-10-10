<footer class="auth-footer">
  <div class="footer-content">
    <a href="home.php" class="back-btn">← Zurück zur Startseite</a>

    <div class="links">
      <a href="datenschutz.php">Datenschutz</a>
      <span>•</span>
      <a href="impressum.php">Impressum</a>
    </div>
  </div>
</footer>
<!-- Cookie-Hinweis -->
<div id="cookie-banner" class="cookie-banner">
  <p>
    Diese Website verwendet Cookies, um dir das bestmögliche Erlebnis zu bieten.
    <a href="datenschutz.php">Mehr erfahren</a>
  </p>
  <button id="cookie-accept">OK</button>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const banner = document.getElementById("cookie-banner");
    const acceptBtn = document.getElementById("cookie-accept");
    const cookieAccepted = localStorage.getItem("cookieAccepted");

    if (!cookieAccepted) {
      banner.style.display = "flex";
    }

    acceptBtn.addEventListener("click", function() {
      localStorage.setItem("cookieAccepted", "true");
      banner.style.display = "none";
    });
  });
</script>

</body>
</html>