<?php
    session_start();
    require '../service/koneksi.php';
    
    $id = $_POST['id'];
    $no_rm = $_POST['no_rm'];
    $nama_pasien = $_POST['nama_pasien'];
    $keluhan = $_POST['keluhan'];
    $status = $_POST['status'];

    $query = "UPDATE pasien_konsultasi SET no_rm='$no_rm', nama_pasien='$nama_pasien', keluhan='$keluhan', status='$status' WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../dashboardAdmin.php");
        exit();
    } else {
        echo "Gagal update data: " . mysqli_error($koneksi);
    }
?>