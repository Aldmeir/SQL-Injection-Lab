<?php
session_start();
include("db.php");

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sadece admin erişebilsin
if ($_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Ürün ekleme işlemi
if (isset($_POST['add_product'])) {
    $category = $_POST['category'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $img_url = $_POST['img_url'];

    $sql = "INSERT INTO products (category, product_name, price, img_url) 
            VALUES ('$category', '$product_name', '$price', '$img_url')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Ürün başarıyla eklendi!</p>";
    } else {
        echo "<p class='error'>Hata: " . $conn->error . "</p>";
    }
}

// Ürün silme işlemi
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Ürün silindi!</p>";
    } else {
        echo "<p class='error'>Hata: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Ürün Yönetimi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Anasayfa</a></li>
        <li><a href="union_based.php">Union Based</a></li>
        <li><a href="boolean_based.php">Boolean Based</a></li>
        <li><a href="time_based.php">Time Based</a></li>
        <li><a href="admin_panel.php">Admin Paneli</a></li>
        <li><a href="profile.php">Profil</a></li>
        <li><a href="logout.php">Çıkış Yap</a></li>
    </ul>
</nav>

<main>
    <h2>Admin Panel - Ürün Yönetimi</h2>

    <div class="container">
        <h3>Yeni Ürün Ekle</h3>
        <form method="POST">
            <input type="text" name="category" placeholder="Kategori">
            <input type="text" name="product_name" placeholder="Ürün Adı" required>
            <input type="number" name="price" placeholder="Fiyat">
            <input type="text" name="img_url" placeholder="Görsel URL">
            <button type="submit" name="add_product">Ürün Ekle</button>
        </form>
    </div>

    <h3>Mevcut Ürünler</h3>
    <div class="filter">
        <input type="text" id="search" placeholder="Ürün Ara...">
    </div>

    <div id="product-list">
        <?php
        $result = $conn->query("SELECT * FROM products");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>
                    <img src='{$row['img_url']}' alt='{$row['product_name']}'>
                    <div>
                        <h3>{$row['product_name']}</h3>
                        <p>Kategori: {$row['category']}</p>
                        <p>Fiyat: {$row['price']}₺</p>
                        <a class='delete-btn' href='admin_panel.php?delete={$row['id']}'>Sil</a>
                    </div>
                  </div>";
        }
        ?>
    </div>

</main>

<script>
    document.getElementById("search").addEventListener("keyup", function() {
        let value = this.value.toLowerCase();
        let products = document.querySelectorAll(".product");
        products.forEach(function(product) {
            let name = product.querySelector("h3").textContent.toLowerCase();
            product.style.display = name.includes(value) ? "flex" : "none";
        });
    });
</script>

</body>
</html>
