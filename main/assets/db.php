<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "webuser";
$pass = "9oo*nlqoLZ2u!w3QO@vk";
$dbname = "jqpollag";

try {
    $conn = new mysqli($host, $user, $pass, $dbname);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("DB-Verbindung fehlgeschlagen: " . $e->getMessage());
}
