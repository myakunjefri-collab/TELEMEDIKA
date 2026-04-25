<?php
session_start();
require './service/koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pasien Baru - Admin TeleMedika</title>
    <style>
        /* reset */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #e8f1f1; color: #105f68; min-height: 100vh; display: flex; flex-direction: column; }

        /* navbar atas */
        .top-navbar { background: #105f68; padding: 20px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(16,95,104,0.1); }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.4rem; color: white; }
        .logo-box { width: 22px; height: 12px; background: #63c1bb; border-radius: 10px 10px 0 0; }

        /* wrapper tengah */
        .main-wrapper { flex: 1; display: flex; justify-content: center; align-items: center; padding: 50px 5%; }

        /* desain kartu form */
        .form-card { 
            background: #ffffff; 
            border-radius: 20px; 
            padding: 50px 40px; 
            box-shadow: 0 10px 40px rgba(16, 95, 104, 0.1); 
            border: 2px solid #d4e8e6; 
            width: 100%; 
            max-width: 550px; 
            position: relative; 
            overflow: hidden; 
        }
        .form-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: #63c1bb; }
        
        .form-title { font-size: 1.8rem; font-weight: 800; margin-bottom: 10px; color: #105f68; text-align: center; }
        .form-desc { font-size: 0.95rem; color: #3a9295; margin-bottom: 35px; text-align: center; }

        /* elemen input */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 700; margin-bottom: 8px; color: #105f68; font-size: 0.9rem; }
        .form-group input, .form-group textarea { 
            width: 100%; 
            padding: 16px; 
            border: 2px solid #eef7f6; 
            border-radius: 10px; 
            outline: none; 
            font-size: 1rem; 
            color: #105f68; 
            background: #fbfdfd; 
            transition: 0.3s; 
        }
        .form-group input:focus, .form-group textarea:focus { border-color: #63c1bb; background: white; box-shadow: 0 0 0 4px rgba(99,193,187,0.1); }
        .form-group textarea { resize: vertical; min-height: 120px; }

        /* tombol */
        .btn-submit { width: 100%; background: #105f68; color: white; padding: 18px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; transition: 0.3s; font-size: 1rem; margin-top: 10px; }
        .btn-submit:hover { background: #0d4a52; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16,95,104,0.15); }
        
        .btn-cancel { display: block; width: 100%; text-align: center; background: #f8fbfb; color: #3a9295; padding: 16px; border: 2px solid #eef7f6; border-radius: 10px; font-weight: 700; text-decoration: none; transition: 0.3s; font-size: 1rem; margin-top: 15px; }
        .btn-cancel:hover { background: #eef7f6; color: #105f68; }

    </style>
</head>
<body>

    <nav class="top-navbar">
        <div class="logo">
            <div class="logo-box"></div>
            TeleMedika Admin
        </div>
    </nav>

    <div class="main-wrapper">
        <div class="form-card">
            <h2 class="form-title">Input Pasien Baru</h2>
            <p class="form-desc">Silakan isi data medis pasien ke dalam sistem antrean.</p>
            
            <form action="proses/prosesTambahPasien.php" method="POST">
                <div class="form-group">
                    <label>Nomor RM (Rekam Medis)</label>
                    <input type="text" name="no_rm" id="no_rm" placeholder="Contoh: RM-2026-001" required>
                </div>
                
                <div class="form-group">
                    <label>Nama Lengkap Pasien</label>
                    <input type="text" name="nama_pasien" id="nama_pasien" placeholder="Masukkan nama pasien" required>
                </div>
                
                <div class="form-group">
                    <label>Keluhan Pasien</label>
                    <textarea name="keluhan" id="keluhan" placeholder="Deskripsikan gejala yang dirasakan..." required></textarea>
                </div>
                
                <button type="submit" class="btn-submit">Simpan Data & Daftarkan</button>
            </form>
            
            <a href="dashboardAdmin.php" class="btn-cancel">Batal & Kembali</a>
        </div>
    </div>

</body>
</html>