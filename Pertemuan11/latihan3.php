
<?php
$koneksi = mysqli_connect("localhost","root",""); //koneksi
mysqli_select_db($koneksi, "lat_dbase"); // mengaktifkan database

//membuat tabel
$sql = "CREATE TABLE IF NOT EXISTS tbl_mhs
(
mhsID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(mhsID),
FirstName varchar(15),
LastName varchar(15),
Age int
)";
mysqli_query($koneksi, $sql);

// input data
$input = mysqli_query($koneksi, "insert into tbl_mhs(FirstName,LastName,Age) values('Anjar','Prabowo',25)");

mysqli_close($koneksi);
?>
