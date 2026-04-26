<?php
    session_start();
    require 'koneksi.php';
    $id = $_GET['id'];

    $query = "DELETE FROM pasien_konsultasi WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: /api/dashboardAdmin");
        exit();
    } else {
        echo "Gagal hapus data: " . mysqli_error($koneksi);
    }
?>