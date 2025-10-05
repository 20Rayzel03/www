  <footer>
    <div>
      <a href="impressum.php">Impressum</a> | 
      <a href="datenschutz.php">Datenschutz</a>
    </div>
    <div>© <?= date("Y") ?> Alle Rechte vorbehalten.</div>
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
