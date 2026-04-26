<?php
    require 'koneksi.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // Gunakan Cookie sebagai pengganti Session (Aktif 1 Hari)
            setcookie("user_id", $user['id'], time() + 86400, "/");
            setcookie("username", $username, time() + 86400, "/");
            setcookie("role", $user['role'], time() + 86400, "/");
            
            // Arahkan berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: /api/dashboardAdmin");
            } else {
                header("Location: /api/index");
            }
            exit();
        } else {
            header("Location: /api/login?error=password");
            exit();
        }
    } else {
        header("Location: /api/login?error=username");
        exit();
    }
?>