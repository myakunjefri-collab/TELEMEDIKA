<?php
require 'koneksi.php';

// Cek menggunakan Cookie
if (!isset($_COOKIE['user_id']) || $_COOKIE['role'] != 'user') {
    header("Location: /api/login"); 
    exit();
}

$username_sekarang = $_COOKIE['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['keluhan'])) {
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $no_rm = "RM-" . date("Y") . "-" . rand(10, 99);
    $status = "Menunggu";
    
    $insert_query = "INSERT INTO pasien_konsultasi (no_rm, nama_pasien, keluhan, status) VALUES ('$no_rm', '$username_sekarang', '$keluhan', '$status')";
    mysqli_query($koneksi, $insert_query);
    
    header("Location: /api/beranda");
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM pasien_konsultasi WHERE nama_pasien = '$username_sekarang' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pasien - TeleMedika</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #e8f1f1; color: #105f68; min-height: 100vh; display: flex; flex-direction: column; }

        .top-navbar { background: #105f68; padding: 20px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 15px rgba(16,95,104,0.1); }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.4rem; color: white; }
        .logo-box { width: 22px; height: 12px; background: #63c1bb; border-radius: 10px 10px 0 0; }
        .btn-home { background: #63c1bb; color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: 0.3s; }
        .btn-home:hover { background: #3a9295; transform: translateY(-2px); }

        .main-wrapper { flex: 1; padding: 50px 5%; max-width: 1350px; margin: 0 auto; width: 100%; }
        .welcome-sec { margin-bottom: 40px; }
        .welcome-sec h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 8px; }

        .dashboard-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 30px; align-items: start; }

        .form-card, .table-card { background: #ffffff; border-radius: 20px; padding: 35px; box-shadow: 0 10px 40px rgba(16, 95, 104, 0.1); border: 2px solid #d4e8e6; }
        .form-title { font-size: 1.3rem; font-weight: 800; margin-bottom: 20px; color: #105f68; }
        
        textarea { width: 100%; padding: 20px; border: 2px solid #eef7f6; border-radius: 12px; outline: none; font-size: 1rem; color: #105f68; min-height: 140px; background: #fbfdfd; }
        .btn-submit { width: 100%; background: #105f68; color: white; padding: 18px; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; margin-top: 15px; }
        .btn-submit:hover { background: #0d4a52; transform: translateY(-2px); }

        .history-table { width: 100%; border-collapse: collapse; }
        .history-table th { text-align: left; padding: 15px; color: #63c1bb; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #eef7f6; }
        .history-table td { padding: 20px 15px; border-bottom: 1px solid #f8fbfb; font-size: 0.95rem; }
        
        .badge { padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; display: inline-block; }
        .badge-waiting { background: #fff8e6; color: #d9822b; }
        .badge-done { background: #e6f7ef; color: #2e8b57; }
        
        .btn-chat-now { background: #63c1bb; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 700; transition: 0.3s; display: inline-block; }
        .btn-chat-now:hover { background: #105f68; }

        .doc-info { font-weight: 700; display: block; }
        .doc-sub { font-size: 0.8rem; color: #3a9295; }

        @media (max-width: 1000px) { .dashboard-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <nav class="top-navbar">
        <div class="logo"><div class="logo-box"></div> TeleMedika</div>
        <a href="/api/index" class="btn-home">Halaman Utama</a>
    </nav>

    <main class="main-wrapper">
        <header class="welcome-sec">
            <h2>Ringkasan Kesehatan</h2>
            <p>Halo <b><?= htmlspecialchars($_COOKIE['username']); ?></b>, pantau antrean medis Anda di sini.</p>
        </header>

        <div class="dashboard-grid">
            
            <div class="form-card">
                <h4 class="form-title">Konsultasi Baru</h4>
                <form action="" method="POST">
                    <textarea name="keluhan" placeholder="Apa yang Anda rasakan? (misal: sakit gigi, flu, dll)" required></textarea>
                    <button type="submit" class="btn-submit">Daftar Antrean</button>
                </form>
            </div>

            <div class="table-card">
                <h4 class="form-title">Antrean & Riwayat</h4>
                <div style="overflow-x: auto;">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>No. RM</th>
                                <th>Keluhan</th>
                                <th>Rekomendasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($query) > 0) : ?>
                                <?php while($row = mysqli_fetch_assoc($query)) : ?>
                                
                                <?php 
                                    $k = strtolower($row['keluhan']);
                                    if (strpos($k, 'gigi') !== false) {
                                        $d_nama = "Dr. Siti Aminah"; $d_slug = "siti"; $d_poli = "Poli Gigi";
                                    } elseif (strpos($k, 'anak') !== false || strpos($k, 'bayi') !== false) {
                                        $d_nama = "Dr. Budi Santoso"; $d_slug = "budi"; $d_poli = "Poli Anak";
                                    } else {
                                        $d_nama = "Dr. Andi Pratama"; $d_slug = "andi"; $d_poli = "Poli Umum";
                                    }
                                ?>

                                <tr>
                                    <td><b><?= $row['no_rm']; ?></b></td>
                                    <td><?= htmlspecialchars($row['keluhan']); ?></td>
                                    <td>
                                        <span class="doc-info"><?= $d_nama; ?></span>
                                        <span class="doc-sub"><?= $d_poli; ?></span>
                                    </td>
                                    <td>
                                        <?php if($row['status'] == 'Menunggu') : ?>
                                            <span class="badge badge-waiting">Menunggu</span>
                                        <?php else : ?>
                                            <span class="badge badge-done"><?= $row['status']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/api/chat?dok=<?= $d_slug; ?>" class="btn-chat-now">Chat Dokter</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr><td colspan="5" style="text-align:center; padding:30px; color:#9ed5d1;">Belum ada riwayat.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>