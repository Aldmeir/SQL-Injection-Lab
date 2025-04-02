<?php
session_start(); // Oturum başlat

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
    <ul>
        <li><a href="index.php">Anasayfa</a></li>
        <li><a href="union_based.php">Union Based</a></li>
        <li><a href="boolean_based.php">Boolean Based</a></li>
        <li><a href="time_based.php">Time Based</a></li>
        <?php if (!isset($_SESSION['username'])): ?>
            <li><a href="./login.php">Giriş</a></li>
            <li><a href="./register.php">Kayıt Ol</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'): ?>
            <li><a href="./admin_panel.php">Ürün Yönetimi</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="./logout.php">Çıkış Yap</a></li>
        <?php endif; ?>
    </ul>
    </nav>
    
    <main>
        <section id="home">
            <h1>Marketimize Hoşgeldiniz</h1>
            <p>Burada kaliteli ürünleri uygun fiyata bulabilirsiniz.</p>
        </section>
    </main>
</body>
</html>
