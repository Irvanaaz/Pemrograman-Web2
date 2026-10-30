<!DOCTYPE html>
<html>

<head>
    <title>Form Input Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            font-size: 14px;
        }

        input,
        select {
            padding: 5px;
            margin: 5px;
        }
    </style>
</head>

<body>

    <div style="padding:10px; width:760px;">
        <form action="action-input-data.php" method="POST">

            <table width="760" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr height="46">
                    <td width="10%"></td>
                    <td width="25%"></td>
                    <td width="65%">
                        <font color="orange" size="4">
                            Form Input Data Mahasiswa
                        </font>
                    </td>
                </tr>

                <tr height="46">
                    <td></td>
                    <td>ID Mahasiswa / NIM</td>
                    <td>
                        <input type="text" name="id_mahasiswa" maxlength="20" required>
                    </td>
                </tr>

                <tr height="46">
                    <td></td>
                    <td>Nama</td>
                    <td>
                        <input type="text" name="nama" maxlength="30" required>
                    </td>
                </tr>

                <tr height="46">
                    <td></td>
                    <td>Jurusan</td>
                    <td>
                        <select name="jurusan" required>
                            <option value="">- Pilih Jurusan -</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Komputer Akuntansi">Komputer Akuntansi</option>
                        </select>
                    </td>
                </tr>

                <tr height="46">
                    <td></td>
                    <td>Alamat</td>
                    <td>
                        <input type="text" name="alamat" maxlength="30" required>
                    </td>
                </tr>

                <tr height="46">
                    <td></td>
                    <td>No. Telp</td>
                    <td>
                        <input type="text" name="telepon" maxlength="12" required>
                    </td>
                </tr>

                <tr height="46">
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" name="Submit" value="Submit">
                        <input type="reset" name="reset" value="Cancel">
                    </td>
                </tr>

            </table>
        </form>
    </div>

</body>

</html>