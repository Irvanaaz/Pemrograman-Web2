<html>
<head>
    <title>Contoh Penggunaan UDF</title>
</head>
<body>

<!-- Menentukan Form Input dengan Method POST -->
<form method="POST" action="">
    Masukkan Bilangan Pertama : <br>
    <input type="text" name="A" size="10"> <br>
    Masukkan Bilangan Kedua : <br>
    <input type="text" name="B" size="10"> <br>
    <input type="submit" name="submit" value="Hitung">
</form>

<?php
// Memeriksa apakah tombol submit sudah ditekan dan input tidak kosong
if (isset($_POST['submit'])) {
    // Mengambil nilai dari form menggunakan $_POST (huruf kapital)
    $A = $_POST["A"];
    $B = $_POST["B"];

    // Definisi Fungsi UDF (User Defined Function)
    function jumlah($A, $B) {
        $jumlahbil = $A + $B;
        return $jumlahbil;
    }

    function kurang($A, $B) {
        $kurangbil = $A - $B;
        return $kurangbil;
    }

    function kali($A, $B) {
        $kalibil = $A * $B;
        return $kalibil;
    }

    function bagi($A, $B) {
        // Mencegah error pembagian dengan angka 0
        if ($B == 0) {
            return "Tidak terhingga (pembagian dengan 0)";
        }
        $bagibil = $A / $B;
        return $bagibil;
    }

    echo "<br>";
    echo "Bilangan Pertama : " . $A . "<br>";
    echo "Bilangan Kedua : " . $B . "<br><br>";

    echo "Hasil Penjumlahan 2 buah bilangan <br>";
    $jumlahbil = jumlah($A, $B); // Hapus tanda &
    printf("Penjumlahan antara : %d + %d = %d", $A, $B, $jumlahbil);
    echo "<br><br>";

    echo "Hasil Pengurangan 2 buah bilangan <br>";
    $kurangbil = kurang($A, $B); // Hapus tanda &
    printf("Pengurangan antara : %d - %d = %d", $A, $B, $kurangbil);
    echo "<br><br>";

    echo "Hasil Perkalian 2 buah bilangan <br>";
    $kalibil = kali($A, $B); // Hapus tanda &
    printf("Perkalian antara : %d * %d = %d", $A, $B, $kalibil);
    echo "<br><br>";

    echo "Hasil Pembagian 2 buah bilangan <br>";
    $bagibil = bagi($A, $B); // Hapus tanda &
    // Jika hasil bagi berupa string (karena pembagian 0), gunakan %s, jika angka gunakan %d / %f
    if (is_numeric($bagibil)) {
        printf("Pembagian antara : %d / %d = %d", $A, $B, $bagibil);
    } else {
        echo "Pembagian antara : $A / $B = " . $bagibil;
    }
    echo "<br><br>";
}
?>

</body>
</html>