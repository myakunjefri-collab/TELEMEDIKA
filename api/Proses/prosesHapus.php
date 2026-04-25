<?php
    session_start();
    require '../service/koneksi.php';
    $id = $_GET['id'];

    $query = "DELETE FROM pasien_konsultasi WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../dashboardAdmin.php");
        exit();
    } else {
        echo "Gagal hapus data: " . mysqli_error($koneksi);
    }
?>