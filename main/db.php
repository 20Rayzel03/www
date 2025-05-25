<?php
$servername = "localhost"; // oder IP deines Servers
$username = "";
$password = "";
$database = "JP-Login";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>
