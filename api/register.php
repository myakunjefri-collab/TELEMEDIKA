<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Konsultasi Dokter Online</title>
    <link rel="stylesheet" href="assets/css/auth.css"> 
    <style>
        /* reset & font */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Roboto, sans-serif; }
        
        /* background utama */
        body { background: #c8e6e2; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        
        /* kontainer utama */
        .register-container { display: flex; max-width: 900px; width: 100%; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(16, 95, 104, 0.15); }
        
        /* sisi kiri: info */
        .side-info { background: linear-gradient(135deg, #105f68 0%, #3a9295 100%); padding: 60px; width: 45%; color: white; display: flex; flex-direction: column; justify-content: center; }
        .side-info h1 { font-size: 2.2rem; margin-bottom: 20px; line-height: 1.2; }
        .side-info p { font-size: 1rem; line-height: 1.6; opacity: 0.9; margin-bottom: 30px; }
        .line-accent { width: 50px; height: 4px; background: #63c1bb; border-radius: 2px; margin-bottom: 20px; }
        
        /* sisi kanan: form */
        .side-form { padding: 60px; width: 55%; background: white; display: flex; flex-direction: column; justify-content: center; }
        .side-form h2 { color: #105f68; margin-bottom: 10px; font-size: 1.8rem; }
        .subtitle { color: #3a9295; font-size: 0.9rem; margin-bottom: 30px; }
        
        /* elemen input */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #105f68; font-size: 0.9rem; font-weight: 600; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 14px; border: 1.5px solid #9ed5d1; border-radius: 10px; outline: none; transition: 0.3s; font-size: 0.95rem; color: #105f68; }
        input:focus { border-color: #63c1bb; box-shadow: 0 0 0 4px rgba(99, 193, 187, 0.1); }
        
        /* tombol register */
        button { width: 100%; padding: 14px; border: none; border-radius: 10px; background: #63c1bb; color: white; font-weight: 700; cursor: pointer; font-size: 1rem; transition: 0.3s; box-shadow: 0 4px 12px rgba(99, 193, 187, 0.3); margin-top: 10px; }
        button:hover { background: #3a9295; transform: translateY(-1px); }
        
        /* footer form */
        .footer { text-align: center; margin-top: 30px; font-size: 0.9rem; color: #3a9295; }
        .footer a { color: #105f68; text-decoration: none; font-weight: 700; }
        
        /* notifikasi */
        .alert { padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.85rem; text-align: center; }
        .alert-error { background: #fdeaea; color: #d9534f; border: 1px solid #f5c6cb; }

        /* responsif */
        @media (max-width: 768px) {
            .register-container { flex-direction: column; }
            .side-info, .side-form { width: 100%; padding: 40px; }
            .side-info { text-align: center; align-items: center; }
        }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="side-info">
            <div class="line-accent"></div>
            <h1>Langkah Awal Sehat Anda</h1>
            <p>Bergabunglah dengan platform kami untuk mendapatkan akses langsung ke dokter profesional, resep digital, dan kemudahan dalam memantau riwayat kesehatan Anda.</p>
        </div>

        <div class="side-form">
            <h2>Buat Akun Baru</h2>
            <p class="subtitle">Silakan isi data diri Anda untuk mendaftar</p>

            <?php if(isset($_SESSION['error'])) : ?>
                <div class="alert alert-error"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="proses/prosesRegister.php" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" placeholder="contoh@mail.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" placeholder="Minimal 6 karakter" required>
                </div>
                <button type="submit" name="register">Daftar Sekarang</button>
            </form>

            <div class="footer">
                Sudah punya akun? <a href="login.php">Login di sini</a>
            </div>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>