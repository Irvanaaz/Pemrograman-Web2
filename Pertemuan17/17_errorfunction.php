<?php


class mahasiswa
{
    public $nama = "Irvan";

    public function tampilkan_nama()
    {
        echo "Nama saya adalah: " . $this->nama;
    }

    public function tampilkan_alamat($alamat)
    {
        echo "Alamat saya adalah: " . $alamat;
    }
}

$mhs = new mahasiswa();
$mhs->tampilkan_nama();
$mhs->tampilkan_alamat("Jl. Merdeka No. 123");



