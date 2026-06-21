<footer class="site-footer">
  <div>
    <strong>JQPOLLAG.DE</strong><br>
    <span>© <?= date("Y") ?> Alle Rechte vorbehalten.</span>
  </div>
  <div class="footer-links">
    <a href="impressum.php">Impressum</a>
    <a href="datenschutz.php">Datenschutz</a>
    <a href="login.php">Login</a>
  </div>
</footer>
<div id="cookie-banner" class="cookie-banner" hidden>
  <p>Diese Website verwendet Cookies, um dir das bestmögliche Erlebnis zu bieten. <a href="datenschutz.php">Mehr erfahren</a></p>
  <button id="cookie-accept" class="btn btn-primary">OK</button>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const banner = document.getElementById("cookie-banner");
  const acceptBtn = document.getElementById("cookie-accept");
  if (banner && acceptBtn && !localStorage.getItem("cookieAccepted")) banner.hidden = false;
  if (acceptBtn) acceptBtn.addEventListener("click", function () { localStorage.setItem("cookieAccepted", "true"); banner.hidden = true; });
});
</script>
</body>
</html>
