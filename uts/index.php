<?php
include 'config/koneksi.php';

$pesan = "";

// PROSES SIMPAN DATA
if (isset($_POST['simpan'])) {

    $tgl_input = $_POST['tgl_input'];
    $kode = strtoupper(trim($_POST['kode']));
    $nama = trim($_POST['nama']);
    $jk = $_POST['jk'];
    $asal_sekolah = trim($_POST['asal_sekolah']);
    $pekerjaan_ortu = trim($_POST['pekerjaan_ortu']);
    $tempat_lahir = trim($_POST['tempat_lahir']);
    $tgl_lahir = $_POST['tgl_lahir'];

    $mat = (float) $_POST['mat'];
    $bing = (float) $_POST['bing'];
    $umum = (float) $_POST['umum'];

    // Hitung rata-rata
    $rata = ($mat + $bing + $umum) / 3;

    // Tentukan keterangan
    if ($rata >= 70) {
        $keterangan = "Lulus";
    } elseif ($rata >= 60) {
        $keterangan = "Cadangan";
    } else {
        $keterangan = "Tidak Lulus";
    }

    // Tentukan tempat tes
    $kode_awal = substr($kode, 0, 1);

    if ($kode_awal == "A") {
        $tempat_tes = "Gedung A";
    } elseif ($kode_awal == "B") {
        $tempat_tes = "Gedung B";
    } elseif ($kode_awal == "V") {
        $tempat_tes = "Viktor";
    } else {
        $tempat_tes = "Tidak Diketahui";
    }

    // Simpan ke database
    $sql = "INSERT INTO mahasiswa
    (tgl_input, kode, nama, jk, asal_sekolah,
    pekerjaan_ortu, tempat_lahir, tgl_lahir,
    mat, bing, umum, rata_rata, tempat_tes, keterangan)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssddddss",
        $tgl_input,
        $kode,
        $nama,
        $jk,
        $asal_sekolah,
        $pekerjaan_ortu,
        $tempat_lahir,
        $tgl_lahir,
        $mat,
        $bing,
        $umum,
        $rata,
        $tempat_tes,
        $keterangan
    );

    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Data mahasiswa berhasil disimpan!";
    } else {
        if (mysqli_stmt_errno($stmt) == 1062) {
            $pesan = "Kode pendaftaran sudah digunakan!";
        } else {
            $pesan = "Gagal menyimpan data: " .
                mysqli_stmt_error($stmt);
        }
    }

    mysqli_stmt_close($stmt);
}

// Ambil seluruh data mahasiswa
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM mahasiswa ORDER BY id DESC"
);

// Hitung rekap
$rekap = mysqli_query(
    $koneksi,
    "SELECT
        COUNT(*) AS total,
        SUM(keterangan = 'Lulus') AS lulus,
        SUM(keterangan = 'Cadangan') AS cadangan,
        SUM(keterangan = 'Tidak Lulus') AS tidak_lulus
     FROM mahasiswa"
);

$data_rekap = mysqli_fetch_assoc($rekap);

function e($data)
{
    return htmlspecialchars((string) $data, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Pendaftaran Mahasiswa Baru</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px;
            background: #f4f4f4;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2,
        h3 {
            text-align: center;
        }

        input[type=text],
        input[type=number],
        input[type=date] {
            width: 100%;
            box-sizing: border-box;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .btn {
            background: blue;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn:hover {
            background: darkblue;
        }

        .info {
            margin-top: 20px;
            padding: 10px;
            background: #eef;
        }

        .pesan {
            padding: 12px;
            margin-bottom: 15px;
            background: #e0f5e5;
            color: #17652b;
            border-radius: 5px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            min-width: 900px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #ddd;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>FORM PENDAFTARAN MAHASISWA BARU</h2>

        <?php if ($pesan != ""): ?>
            <div class="pesan">
                <?= e($pesan); ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>Tanggal Input</label>
            <input type="date" name="tgl_input" required>

            <label>Kode Pendaftaran</label>
            <input type="text" name="kode" placeholder="Contoh: A2" required>

            <label>Nama Pendaftar</label>
            <input type="text" name="nama" required>

            <label>Jenis Kelamin</label><br>
            <input type="radio" name="jk" value="Laki-Laki" required> Laki-Laki

            <input type="radio" name="jk" value="Perempuan"> Perempuan

            <br><br>

            <label>Asal Sekolah</label>
            <input type="text" name="asal_sekolah" required>

            <label>Pekerjaan Orang Tua</label>
            <input type="text" name="pekerjaan_ortu" required>

            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" required>

            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" required>

            <label>Matematika</label>
            <input type="number" name="mat" min="0" max="100" step="0.01" required>

            <label>Bahasa Inggris</label>
            <input type="number" name="bing" min="0" max="100" step="0.01" required>

            <label>Umum</label>
            <input type="number" name="umum" min="0" max="100" step="0.01" required>

            <button type="submit" name="simpan" class="btn">
                SIMPAN
            </button>

        </form>

        <hr>

        <h2>REKAP DATA PENDAFTAR</h2>

        <div class="info">
            <p>Jumlah Pendaftar:
                <b><?= $data_rekap['total'] ?? 0; ?></b>
            </p>

            <p>Jumlah Peserta Lulus:
                <b><?= $data_rekap['lulus'] ?? 0; ?></b>
            </p>

            <p>Jumlah Peserta Cadangan:
                <b><?= $data_rekap['cadangan'] ?? 0; ?></b>
            </p>

            <p>Jumlah Tidak Lulus:
                <b><?= $data_rekap['tidak_lulus'] ?? 0; ?></b>
            </p>
        </div>

        <h2>DATA MAHASISWA TERSIMPAN</h2>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Tanggal Lahir</th>
                    <th>Asal Sekolah</th>
                    <th>Pekerjaan Ortu</th>
                    <th>Tempat Tes</th>
                    <th>MAT</th>
                    <th>B. Inggris</th>
                    <th>Umum</th>
                    <th>Rata-rata</th>
                    <th>Keterangan</th>
                </tr>

                <?php
                $no = 1;

                if (mysqli_num_rows($query) > 0):
                    while ($data = mysqli_fetch_assoc($query)):
                        ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= e($data['kode']); ?></td>
                            <td><?= e($data['nama']); ?></td>
                            <td><?= e($data['jk']); ?></td>
                            <td>
                                <?= e($data['tempat_lahir']); ?>,
                                <?= e($data['tgl_lahir']); ?>
                            </td>
                            <td><?= e($data['asal_sekolah']); ?></td>
                            <td><?= e($data['pekerjaan_ortu']); ?></td>
                            <td><?= e($data['tempat_tes']); ?></td>
                            <td><?= e($data['mat']); ?></td>
                            <td><?= e($data['bing']); ?></td>
                            <td><?= e($data['umum']); ?></td>
                            <td><?= number_format($data['rata_rata'], 2); ?></td>
                            <td><?= e($data['keterangan']); ?></td>
                        </tr>

                        <?php
                    endwhile;
                else:
                    ?>

                    <tr>
                        <td colspan="13">Belum ada data mahasiswa.</td>
                    </tr>

                <?php endif; ?>

            </table>
        </div>

        <div class="info">
            <h3>KETERANGAN</h3>

            <p><b>Kode Tempat Tes:</b></p>
            <ul>
                <li>A = Gedung A</li>
                <li>B = Gedung B</li>
                <li>V = Viktor</li>
            </ul>

            <p><b>Hasil Seleksi:</b></p>
            <ul>
                <li>Rata-rata ≥ 70 = Lulus</li>
                <li>Rata-rata 60 - 69,99 = Cadangan</li>
                <li>Rata-rata di bawah 60 = Tidak Lulus</li>
            </ul>
        </div>

    </div>

</body>

</html>