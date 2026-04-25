<?php
    session_start();
    require '../service/koneksi.php';
    
    $no_rm = $_POST['no_rm'];
    $nama_pasien = $_POST['nama_pasien'];
    $keluhan = $_POST['keluhan'];
    $status = 'Menunggu';

    $query = "INSERT INTO pasien_konsultasi (no_rm, nama_pasien, keluhan, status) VALUES ('$no_rm', '$nama_pasien', '$keluhan', '$status')";
    
    if(mysqli_query($koneksi, $query)) {
        header("Location: ../dashboardAdmin.php");
        exit();
    } else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
?>