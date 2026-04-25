<?php
    session_start();
    require '../service/koneksi.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            if (isset($_POST['remember'])) {
                setcookie("username", $username, time() + 3600, "/"); 
            }
            
            // Arahkan berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: ../dashboardAdmin.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Password yang Anda masukkan salah!";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username tidak terdaftar di sistem kami.";
        header("Location: ../login.php");
        exit();
    }
?>