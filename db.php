<?php
$host = "localhost";
$user = "*";
$pass = "*";
$dbname = "mydatabase";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
