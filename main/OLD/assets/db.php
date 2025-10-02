<?php
$host = "localhost";
$user = "webuser";     
$pass = "9oo*nlqoLZ2u!w3QO@vk"; 
$dbname = "jqpollag"; 

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>
