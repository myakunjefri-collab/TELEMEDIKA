<?php
require 'koneksi.php';

// Validasi Admin menggunakan Cookie
if (!isset($_COOKIE['user_id']) || $_COOKIE['role'] != 'admin') {
    header("Location: /api/login"); 
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM pasien_konsultasi ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TeleMedika</title>
    <style>
        /* reset */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #e8f1f1; color: #105f68; min-height: 100vh; display: flex; flex-direction: column; }

        /* navbar */
        .top-navbar { background: #105f68; padding: 20px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(16,95,104,0.1); }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.4rem; color: white; }
        .logo-box { width: 22px; height: 12px; background: #63c1bb; border-radius: 10px 10px 0 0; }
        .btn-logout { background: #fff0f0; color: #d9534f; padding: 10px 25px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: 0.3s; border: 1px solid #fadcd9; }
        .btn-logout:hover { background: #d9534f; color: white; transform: translateY(-2px); }

        /* wrapper */
        .main-wrapper { flex: 1; padding: 50px 5%; max-width: 1200px; margin: 0 auto; width: 100%; }
        .welcome-sec { margin-bottom: 40px; display: flex; justify-content: space-between; align-items: flex-end; }
        .welcome-sec h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 8px; }
        .welcome-sec p { color: #3a9295; font-size: 1.05rem; }

        /* card */
        .table-card { background: #ffffff; border-radius: 20px; padding: 40px; box-shadow: 0 10px 40px rgba(16, 95, 104, 0.1); border: 2px solid #d4e8e6; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .form-title { font-size: 1.4rem; font-weight: 800; color: #105f68; }
        
        .btn-add { background: #63c1bb; color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 700; transition: 0.3s; display: inline-block; }
        .btn-add:hover { background: #3a9295; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(99,193,187,0.2); }

        /* table */
        .history-table { width: 100%; border-collapse: collapse; }
        .history-table th { text-align: left; padding: 15px 20px; color: #63c1bb; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #eef7f6; }
        .history-table td { padding: 20px; border-bottom: 1px solid #f8fbfb; font-size: 0.95rem; vertical-align: middle; }
        
        /* action buttons */
        .btn-edit { background: #eef7f6; color: #105f68; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 700; transition: 0.3s; display: inline-block; margin-right: 5px; border: 1px solid #c8e6e2; }
        .btn-edit:hover { background: #105f68; color: white; }
        
        .btn-delete { background: #fff0f0; color: #d9534f; padding: 8px 15px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 700; transition: 0.3s; display: inline-block; border: 1px solid #fadcd9; }
        .btn-delete:hover { background: #d9534f; color: white; }

        /* status badge */
        .badge { padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; display: inline-block; }
        .badge-waiting { background: #fff8e6; color: #d9822b; border: 1px solid #ffe8b3; }
        .badge-done { background: #e6f7ef; color: #2e8b57; border: 1px solid #cceadd; }

        @media (max-width: 768px) {
            .welcome-sec { flex-direction: column; align-items: flex-start; gap: 15px; }
            .card-header { flex-direction: column; align-items: flex-start; gap: 15px; }
        }
    </style>
</head>
<body>

    <nav class="top-navbar">
        <div class="logo"><div class="logo-box"></div> TeleMedika Admin</div>
        <a href="/api/logout" class="btn-logout">Logout</a>
    </nav>

    <main class="main-wrapper">
        <header class="welcome-sec">
            <div>
                <h2>Panel Admin Utama</h2>
                <p>Kelola data antrean dan status pasien dengan mudah.</p>
            </div>
        </header>

        <div class="table-card">
            <div class="card-header">
                <h4 class="form-title">Manajemen Antrean Pasien</h4>
                <a href="/api/tambah_pasien" class="btn-add">+ Input Pasien Baru</a>
            </div>
            
            <div style="overflow-x: auto;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($query) > 0) : ?>
                            <?php while($row = mysqli_fetch_assoc($query)) : ?>
                            <tr>
                                <td><b style="color: #105f68;"><?= $row['no_rm']; ?></b></td>
                                <td><?= htmlspecialchars($row['nama_pasien']); ?></td>
                                <td><?= htmlspecialchars($row['keluhan']); ?></td>
                                <td>
                                    <?php if(isset($row['status'])) : ?>
                                        <?php if($row['status'] == 'Menunggu') : ?>
                                            <span class="badge badge-waiting">Menunggu</span>
                                        <?php else : ?>
                                            <span class="badge badge-done"><?= htmlspecialchars($row['status']); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge badge-waiting">Menunggu</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/api/edit_pasien?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="/api/prosesHapus?id=<?= $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus data pasien <?= htmlspecialchars($row['nama_pasien']); ?>?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr><td colspan="5" style="text-align:center; padding:30px; color:#9ed5d1;">Belum ada data pasien dalam sistem.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>