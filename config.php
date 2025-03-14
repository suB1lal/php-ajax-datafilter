<?php
// Veritabanı bağlantı bilgileri
$host = "127.0.0.1"; // Yerel sunucu
$username = "root";  // MySQL kullanıcı adı
$password = "";      // MySQL şifresi (boş bırakılmış, yerel geliştirme için yaygın)
$database = "live_search"; // Veritabanı adı

// Bağlantıyı kur
$conn = mysqli_connect($host, $username, $password, $database);

// Bağlantıyı kontrol et
if (!$conn) {
    die("Bağlantı başarısız: " . mysqli_connect_error() . " (Hata Kodu: " . mysqli_connect_errno() . ")");
}

mysqli_set_charset($conn, "utf8mb4");

?>