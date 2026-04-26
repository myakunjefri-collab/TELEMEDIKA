<?php
require 'koneksi.php';

// Proteksi Admin
if (!isset($_COOKIE['user_id']) || $_COOKIE['role'] != 'admin') {
    header("Location: /api/login");
    exit();
}

// Menangkap 'id' dari parameter URL
if (!isset($_GET['id'])) {
    header("Location: /api/dashboardAdmin");
    exit();
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM pasien_konsultasi WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data pasien tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien - Telemedicine</title>
    <link rel="stylesheet" href="/auth.css"> <style>
        .auth-card { max-width: 500px; border-top: 5px solid #007bff; }
        .form-group label { font-weight: bold; color: #333; margin-bottom: 5px; display: block; }
        textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn { background: #007bff; border: none; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2>Perbarui Data Pasien</h2>
        <p style="color: #666; font-size: 0.9rem;">Kelola detail medis pasien di bawah ini.</p>
        <hr>
        
        <form action="/api/prosesEditPasien" method="POST">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            
            <div class="form-group">
                <label for="no_rm">No. Rekam Medis (RM)</label>
                <input type="text" name="no_rm" id="no_rm" value="<?= $data['no_rm']; ?>" readonly style="background: #f0f0f0;">
                <small>*No RM tidak dapat diubah</small>
            </div>
            
            <div class="form-group">
                <label for="nama_pasien">Nama Lengkap Pasien</label>
                <input type="text" name="nama_pasien" id="nama_pasien" value="<?= $data['nama_pasien']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="keluhan">Keluhan Utama</label>
                <textarea name="keluhan" id="keluhan" rows="4" required><?= $data['keluhan']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status Konsultasi</label>
                <select name="status" id="status" style="width: 100%; padding: 10px; border-radius: 5px;">
                    <option value="Menunggu" <?= $data['status'] == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                    <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                </select>
            </div>
            
            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
        
        <div class="auth-footer">
            <br>
            <a href="/api/dashboardAdmin" style="color: #007bff; text-decoration: none;">&larr; Kembali ke Panel Admin</a>
        </div>
    </div>
</body>
</html>