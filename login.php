<?php
session_start(); // Oturum başlat

include("db.php");


// Giriş işlemi
if (isset($_POST['login'])) {
    // Kullanıcıdan gelen verileri al
    $user = $_POST['username'];
    $pass = $_POST['password'];
 
    // SQL sorgusu ile kullanıcıyı veritabanında ara (SQL Injection'a açık)
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Kullanıcı bulundu, giriş başarılı
        $_SESSION['username'] = $user; // Session'a kullanıcı adı ekle
        $_SESSION['logged_in'] = true; // Giriş yapıldığını belirten bir flag

        // Kullanıcıyı profil sayfasına yönlendir
        header("Location: profile.php");
        exit(); // Yönlendirmeden sonra işlemi sonlandır
    } else {
        // Kullanıcı adı veya şifre hatalı
        echo "Geçersiz kullanıcı adı veya şifre!";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="./index.php">Anasayfa</a></li>
            <li><a href="union_based.php">Union Based</a></li>
            <li><a href="boolean_based.php">Boolean Based</a></li>
            <li><a href="time_based.php">Time Based</a></li>
            <li><a href="./login.php">Giriş</a></li>
            <li><a href="./register.php">Kayıt Ol</a></li>
        </ul>
    </nav>
    
    <main>
        <div class="container">
            <h2>Giriş Yap</h2>
            <form method="POST" action="login.php">
                <input type="text" name="username" placeholder="Kullanıcı Adı" required>
                <input type="password" name="password" placeholder="Şifre" >
                <button type="submit" name="login">Giriş Yap</button>
            </form>
        </div>
    </main>
</body>
</html>
