<?php
session_start(); // Oturum başlat

// Oturumu sonlandır
session_unset(); // Tüm session verilerini temizle
session_destroy(); // Oturumu sonlandır

// Giriş sayfasına yönlendir
header("Location: login.php");
exit();
?>
