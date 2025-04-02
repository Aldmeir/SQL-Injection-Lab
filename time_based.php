<?php
session_start(); // Oturum başlat

include("db.php"); // Veritabanı bağlantısı

// Kategori filtresi
error_reporting(E_ALL);  // Tüm hataları raporla
ini_set('display_errors', 1);  // Hataları ekrana yazdır

$category = isset($_GET['category']) ? $_GET['category'] : 'all';


if ($category !== 'all') {
    if (preg_match("/sleep|benchmark|if|select|union/i", $category)) {
        $sql = "SELECT * FROM products WHERE category = '$category'";
    } else {
        $sql = "SELECT * FROM products WHERE category = '$category'";
    }
} else {
    $sql = "SELECT * FROM products WHERE category != ''";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
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
                <li><a href="login.php">Giriş</a></li>
                <li><a href="register.php">Kayıt Ol</a></li>
            <?php else: ?>
                <li><a href="profile.php">Profil</a></li>
                <?php if ($_SESSION['username'] == 'admin'): ?>
                    <li><a href="admin_panel.php">Admin Paneli</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Çıkış</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <h2>Ürünler</h2>
        <div class="filter">
            <a href="urunler3.php?category=all"><button>Tümü</button></a>
            <a href="urunler3.php?category=elektronik"><button>Elektronik</button></a>
            <a href="urunler3.php?category=giyim"><button>Giyim</button></a>
            <a href="urunler3.php?category=gida"><button>Gıda</button></a>
        </div>

        <div id="product-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product {$row['category']}'>
                            <img src='{$row['img_url']}' alt='{$row['product_name']}'>
                            <p>{$row['product_name']} - {$row['price']} TL</p>
                          </div>";
                }
            } else {
                echo "<p>Bu kategoride ürün bulunamadı.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
