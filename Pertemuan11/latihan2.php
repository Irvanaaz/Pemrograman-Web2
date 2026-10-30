
<?php
// Koneksi ke server MySQL
$koneksi = mysqli_connect("localhost", "root", "");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Nama database
$dbname = "lat_dbase";

// Membuat database
$sql = "CREATE DATABASE $dbname";

$cek = mysqli_query($koneksi, $sql);

if ($cek) {
    echo "Database $dbname berhasil dibuat";
} else {
    die("Database gagal dibuat: " . mysqli_error($koneksi));
}

// Menutup koneksi
mysqli_close($koneksi);
?>
