<?php
// Teks yang akan dimasukkan ke dalam file
$isi_file = "Hello, this is a test file.\n" .
            "There are three lines here.\n" .
            "This is the last line.";

// Nama file tujuan
$nama_file = "test1.txt";

// Membuat dan menulis teks ke dalam file
if (file_put_contents($nama_file, $isi_file) !== false) {
    echo "Berhasil! File <b>$nama_file</b> telah dibuat.";
} else {
    echo "Gagal membuat file.";
}
?>