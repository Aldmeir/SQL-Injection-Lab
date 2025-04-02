<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="union_based.php">Union Based</a></li>
            <li><a href="boolean_based.php">Boolean Based</a></li>
            <li><a href="time_based.php">Time Based</a></li>
            <li><a href="login.php">Giriş</a></li>
            <li><a href="register.php">Kayıt Ol</a></li>
        </ul>
    </nav>
    
    <main>
        <div class="container">
            <h2>Kayıt Ol</h2>
            <form method="POST" action="register.php">
                <input type="text" name="username" placeholder="Kullanıcı Adı" required>
                <input type="password" name="password" placeholder="Şifre" required>
                <button type="submit" name="register">Kayıt Ol</button>
            </form>
        </div>
    </main>
</body>
</html>
<?php
include("db.php") ;

// Kayıt işlemi
if (isset($_POST['register'])) {
    // Kullanıcıdan gelen verileri al
    $user = $_POST['username'];
    $pass = $_POST['password'];


    // SQL sorgusu ile kullanıcıyı veritabanına ekle
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarılı!";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
