
<?php

// Cek tombol Submit
if (isset($_POST['Submit'])) {

    $id_mahasiswa = trim($_POST['id_mahasiswa']);
    $nama = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);
    $alamat = trim($_POST['alamat']);
    $telepon = trim($_POST['telepon']);

    // Validasi data kosong
    if (
        empty($id_mahasiswa) ||
        empty($nama) ||
        empty($jurusan) ||
        empty($alamat) ||
        empty($telepon)
    ) {
        echo "<script>
            alert('Data Harap Dilengkapi!');
            document.location='form-input-data.php';
        </script>";
        exit;
    }

    // Koneksi database
    include "koneksi.php";

    // Cek NIM di database
    $id_aman = mysqli_real_escape_string($connection, $id_mahasiswa);

    $cek = mysqli_query(
        $connection,
        "SELECT id_mahasiswa FROM mahasiswa
         WHERE id_mahasiswa='$id_aman'"
    );

    if (!$cek) {
        die("Gagal memeriksa NIM: " . mysqli_error($connection));
    }

    if (mysqli_num_rows($cek) > 0) {
        mysqli_close($connection);

        echo "<script>
            alert('NIM sudah dipakai! Silahkan ganti NIM yang lain');
            document.location='form-input-data.php';
        </script>";
        exit;
    }

    // Amankan data sebelum dimasukkan
    $nama = mysqli_real_escape_string($connection, $nama);
    $jurusan = mysqli_real_escape_string($connection, $jurusan);
    $alamat = mysqli_real_escape_string($connection, $alamat);
    $telepon = mysqli_real_escape_string($connection, $telepon);

    // Masukkan data ke tabel mahasiswa
    $input = "INSERT INTO mahasiswa
        (id_mahasiswa, nama, jurusan, alamat, telepon)
        VALUES
        ('$id_aman', '$nama', '$jurusan', '$alamat', '$telepon')";

    $query_input = mysqli_query($connection, $input);

    if ($query_input) {

        mysqli_close($connection);

        echo "<script>
            alert('Input Data Mahasiswa Berhasil');
            document.location='form-input-data.php';
        </script>";

    } else {

        echo "Input Data Mahasiswa Gagal: " . mysqli_error($connection);
        mysqli_close($connection);

    }
}
?>
