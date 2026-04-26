<?php
    session_start();
    require 'koneksi.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    $role = 'user'; 

    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password_hash', '$role')";
    $result = mysqli_query($koneksi, $query);

    if ($result){
        $_SESSION['success'] = "Pendaftaran berhasil! Silakan login untuk melanjutkan.";
        header("Location: /api/login");
        exit();
    } else {
        $_SESSION['error'] = "Mohon maaf, pendaftaran gagal: " . mysqli_error($koneksi);
        header("Location: /api/register");
        exit();
    }
?>