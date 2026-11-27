
<?php

// Mengatur tanggal kedaluwarsa cookie menjadi satu jam yang lalu
setcookie("username", "", time() - 3600);
setcookie("namalengkap", "", time() - 3600);

// Menampilkan pesan
echo "<h1>Cookie Berhasil dihapus.</h1>";

// Link navigasi
echo "<h2>Klik <a href='cookie01.php'>di sini</a> untuk penciptaan cookies</h2>";

echo "<h2>Klik <a href='cookie02.php'>di sini</a> untuk pemeriksaan cookies</h2>";

?>
