<?php
session_start();

/* deteksi dokter dari url */
$dok = isset($_GET['dok']) ? $_GET['dok'] : 'andi';

/* set info dokter */
if ($dok == 'siti') {
    $nama = "Dr. Siti Aminah";
    $spesialis = "Dokter Umum";
    $img = "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=600";
} elseif ($dok == 'budi') {
    $nama = "Dr. Budi Santoso";
    $spesialis = "Spesialis Anak";
    $img = "https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&q=80&w=200";
} else {
    $nama = "Dr. Andi Pratama";
    $spesialis = "Dokter Umum";
    $img = "https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&q=80&w=200";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat dengan <?= $nama; ?></title>
    <style>
        /* reset */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #eef7f6; display: flex; justify-content: center; align-items: center; height: 100vh; }

        /* container utama */
        .chat-container { width: 100%; max-width: 500px; height: 90vh; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(16,95,104,0.1); display: flex; flex-direction: column; overflow: hidden; }

        /* header */
        .header { background: #105f68; padding: 15px 20px; display: flex; align-items: center; gap: 15px; color: white; }
        .btn-back { color: white; text-decoration: none; font-size: 1.5rem; font-weight: bold; }
        .header-img { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #63c1bb; }
        .header-info h3 { font-size: 1rem; margin-bottom: 2px; }
        .header-info p { font-size: 0.75rem; color: #9ed5d1; }
        .status-dot { display: inline-block; width: 8px; height: 8px; background: #5cb85c; border-radius: 50%; margin-right: 5px; }

        /* area pesan */
        .chat-box { flex: 1; padding: 20px; overflow-y: auto; background: #f8fbfb; display: flex; flex-direction: column; gap: 15px; }
        
        /* bubble */
        .msg { max-width: 75%; padding: 12px 15px; border-radius: 15px; font-size: 0.9rem; line-height: 1.4; position: relative; }
        .msg-time { font-size: 0.65rem; display: block; margin-top: 5px; text-align: right; opacity: 0.7; }
        
        /* pesan dokter (kiri) */
        .msg-doc { background: white; color: #105f68; border: 1px solid #eef7f6; border-bottom-left-radius: 2px; align-self: flex-start; }
        
        /* pesan pasien (kanan) */
        .msg-user { background: #c8e6e2; color: #105f68; border-bottom-right-radius: 2px; align-self: flex-end; }

        /* area ketik */
        .input-area { padding: 15px; background: white; border-top: 1px solid #eef7f6; display: flex; gap: 10px; align-items: center; }
        .input-box { flex: 1; padding: 12px 15px; border: 1px solid #c8e6e2; border-radius: 25px; outline: none; font-size: 0.9rem; color: #105f68; }
        .input-box:focus { border-color: #63c1bb; }
        .btn-send { background: #63c1bb; color: white; width: 45px; height: 45px; border-radius: 50%; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
        .btn-send:hover { background: #3a9295; }
        .btn-send svg { width: 20px; height: 20px; fill: white; }

        /* peringatan */
        .system-msg { text-align: center; font-size: 0.75rem; color: #9ed5d1; margin: 10px 0; background: white; padding: 5px 10px; border-radius: 10px; align-self: center; border: 1px solid #eef7f6; }
    </style>
</head>
<body>

    <div class="chat-container">
        
        <div class="header">
            <a href="index.php" class="btn-back">&lsaquo;</a>
            <img src="<?= $img; ?>" class="header-img" alt="Foto">
            <div class="header-info">
                <h3><?= $nama; ?></h3>
                <p><span class="status-dot"></span>Online | <?= $spesialis; ?></p>
            </div>
        </div>

        <div class="chat-box">
            <div class="system-msg">Konsultasi dimulai. Percakapan ini dienkripsi.</div>

            <div class="msg msg-doc">
                Halo! Saya <?= $nama; ?>. Ada keluhan kesehatan apa yang bisa saya bantu hari ini?
                <span class="msg-time">10:00</span>
            </div>

            <div class="msg msg-user">
                Selamat pagi Dok, kepala saya pusing sebelah sejak kemarin dan rasanya berdenyut.
                <span class="msg-time">10:02</span>
            </div>

            <div class="msg msg-doc">
                Baik, sudah berapa lama pusingnya muncul? Apakah disertai mual atau pandangan kabur?
                <span class="msg-time">10:03</span>
            </div>
        </div>

        <div class="input-area">
            <input type="text" class="input-box" placeholder="Ketik keluhan Anda...">
            <button class="btn-send">
                <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
            </button>
        </div>

    </div>

</body>
</html>