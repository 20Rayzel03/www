<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
function require_login(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
function is_admin(): bool {
    return !empty($_SESSION['is_admin']) && (int)$_SESSION['is_admin'] === 1;
}
function require_admin(): void {
    require_login();
    if (!is_admin()) {
        http_response_code(403);
        $pageTitle = 'Kein Zugriff';
        include __DIR__ . '/header.php';
        echo '<main class="section"><div class="container glass-card"><h1>Kein Zugriff</h1><p class="muted">Dieser Bereich ist nur für Admins freigegeben.</p><p><a class="btn btn-ghost" href="dashboard.php">Zurück zum Dashboard</a></p></div></main>';
        include __DIR__ . '/footer.php';
        exit;
    }
}
?>
