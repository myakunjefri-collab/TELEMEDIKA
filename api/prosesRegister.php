<?php
    require 'koneksi.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    $role = 'user'; 

    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password_hash', '$role')";
    $result = mysqli_query($koneksi, $query);

    if ($result){
        header("Location: /api/login?pesan=sukses");
        exit();
    } else {
        header("Location: /api/register?error=gagal");
        exit();
    }
?>