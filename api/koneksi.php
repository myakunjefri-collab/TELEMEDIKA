<?php
// Data dari TiDB Cloud
$host = 'gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com';
$port = 4000;
$user = 'cpCH3aB6Z1ksKyu.root';
$pass = 'N5mt7zsDSFCBBaPX';
$db   = 'db-konsultasi';

// Inisialisasi mysqli
$koneksi = mysqli_init();

// Menambahkan pengaturan SSL (Wajib untuk TiDB Serverless)
mysqli_ssl_set($koneksi, NULL, NULL, NULL, NULL, NULL);

// Melakukan koneksi
$real_connect = mysqli_real_connect(
    $koneksi, 
    $host, 
    $user, 
    $pass, 
    $db, 
    $port, 
    NULL, 
    MYSQLI_CLIENT_SSL
);

if (!$real_connect) {
    die("Koneksi ke TiDB Cloud gagal: " . mysqli_connect_error());
}
?>