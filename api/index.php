<?php
// cek admin via Cookie
if (isset($_COOKIE['user_id']) && $_COOKIE['role'] == 'admin') {
    header("Location: /api/dashboardAdmin");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeleMedika - Konsultasi Online</title>
    <style>
        /* reset */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #f8fbfb; color: #105f68; overflow-x: hidden; }

        /* nav */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 20px 5%; background: white; box-shadow: 0 2px 15px rgba(16,95,104,0.05); position: sticky; top: 0; z-index: 100; }
        .logo { display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 1.2rem; }
        .logo-box { width: 18px; height: 18px; background: #63c1bb; border-radius: 4px; }
        .nav-actions { display: flex; gap: 15px; align-items: center; }
        .btn-nav { padding: 10px 20px; border-radius: 20px; text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: 0.3s; }
        .btn-login { background: #105f68; color: white; }
        .btn-dash { background: #63c1bb; color: white; }

        /* container */
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 5%; }

        /* hero */
        .hero { background: linear-gradient(135deg, #c8e6e2 0%, #f8fbfb 100%); border-radius: 24px; padding: 60px 5%; display: flex; align-items: center; justify-content: space-between; margin-bottom: 50px; }
        .hero-text { width: 50%; }
        .hero-text h1 { font-size: 3rem; font-weight: 800; line-height: 1.2; margin-bottom: 15px; letter-spacing: -1px; }
        .hero-text h1 span { color: #63c1bb; }
        .hero-text p { font-size: 1.1rem; color: #3a9295; margin-bottom: 30px; line-height: 1.6; }
        .hero-img-wrap { width: 45%; position: relative; }
        .hero-img { width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(16,95,104,0.1); }
        .float-badge { position: absolute; bottom: -20px; left: -20px; background: white; padding: 15px; border-radius: 12px; box-shadow: 0 10px 20px rgba(16,95,104,0.1); font-weight: 700; font-size: 0.9rem; }

        /* judul */
        .section-title { font-size: 1.6rem; margin-bottom: 25px; font-weight: 800; display: flex; align-items: center; gap: 10px; }
        .section-title::before { content: ''; width: 6px; height: 25px; background: #63c1bb; border-radius: 10px; }

        /* chat grid */
        .chat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 60px; }
        .doc-card { background: white; padding: 25px 20px; border-radius: 20px; text-align: center; box-shadow: 0 10px 30px rgba(16,95,104,0.05); }
        .doc-img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 3px solid #c8e6e2; }
        .status { font-size: 0.75rem; font-weight: 700; color: #63c1bb; display: block; margin-bottom: 5px; }
        .btn-chat { display: block; padding: 12px; background: #f2f8f8; color: #105f68; text-decoration: none; border-radius: 10px; font-weight: 700; margin-top: 15px; transition: 0.3s; }
        .btn-chat:hover { background: #63c1bb; color: white; }

        /* tabel */
        .table-wrap { background: white; border-radius: 20px; overflow: hidden; margin-bottom: 60px; box-shadow: 0 10px 30px rgba(16,95,104,0.05); }
        table { width: 100%; border-collapse: collapse; }
        th { background: #eef7f6; padding: 18px; text-align: left; font-size: 0.95rem; }
        td { padding: 18px; border-bottom: 1px solid #f8fbfb; font-size: 0.9rem; color: #3a9295; font-weight: 500; }
        tr:hover { background: #f8fbfb; }

        /* artikel */
        .art-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 40px; }
        .art-card { background: white; border-radius: 20px; overflow: hidden; text-decoration: none; color: inherit; box-shadow: 0 10px 30px rgba(16,95,104,0.05); transition: 0.3s; }
        .art-card:hover { transform: translateY(-5px); }
        .art-img { width: 100%; height: 200px; object-fit: cover; }
        .art-body { padding: 25px; position: relative; }
        .badge { position: absolute; top: -15px; left: 20px; background: #63c1bb; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
        .art-body h4 { margin-bottom: 10px; font-size: 1.05rem; line-height: 1.5; color: #105f68; }
        .date { font-size: 0.8rem; color: #9ed5d1; font-weight: 600; }
        .center-btn { text-align: center; margin-bottom: 60px; }
        .btn-outline { border: 2px solid #9ed5d1; color: #105f68; padding: 12px 30px; border-radius: 30px; text-decoration: none; font-weight: 700; transition: 0.3s; display: inline-block; }
        .btn-outline:hover { background: #eef7f6; }

        /* fitur */
        .feat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 60px; }
        .feat-item { background: white; padding: 30px 20px; border-radius: 20px; text-align: center; border: 1px solid #eef7f6; }
        .icon-circle { width: 50px; height: 50px; background: #eef7f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-size: 1.5rem; }
        .feat-item h4 { margin-bottom: 10px; color: #105f68; }
        .feat-item p { font-size: 0.85rem; color: #3a9295; line-height: 1.5; }

        /* footer */
        .footer-wrap { position: relative; margin-top: 50px; }
        .shield-logo { position: absolute; top: -40px; left: 50%; transform: translateX(-50%); width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 -10px 20px rgba(16,95,104,0.05); }
        .shield-inner { width: 60px; height: 60px; background: #9ed5d1; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; font-size: 0.5rem; font-weight: 800; }
        .footer-main { background: #c8e6e2; padding: 70px 5% 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; text-align: center; }
        .footer-main h4 { color: #105f68; margin-bottom: 15px; }
        .footer-main a { color: #3a9295; text-decoration: none; display: block; margin-bottom: 10px; font-size: 0.9rem; }
        .footer-bottom { background: #105f68; color: #9ed5d1; text-align: center; padding: 20px; font-size: 0.85rem; }

        /* hp */
        @media (max-width: 768px) {
            .hero { flex-direction: column; text-align: center; padding: 40px 20px; }
            .hero-text, .hero-img-wrap { width: 100%; }
            .hero-text h1 { font-size: 2.2rem; }
            .table-wrap { overflow-x: auto; }
            th, td { white-space: nowrap; }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <nav>
        <div class="logo">
            <div class="logo-box"></div> TeleMedika
        </div>
        <div class="nav-actions">
            <a href="/api/beranda" class="btn-nav btn-dash">Dashboard</a>
            <a href="/api/logout" class="btn-nav" style="background: #fff0f0; color: #d9534f; border: 1px solid #fadcd9; margin-left: 10px; font-weight:700; text-decoration:none;">Logout</a>
        </div>
    </nav>

    <div class="container">
        
        <div class="hero">
            <div class="hero-text">
                <h1>Konsultasi Kesehatan <span>Kapan Saja.</span></h1>
                <p>Dapatkan diagnosis, resep obat digital, dan panduan medis langsung dari dokter spesialis melalui chat atau video call.</p>
                <a href="/api/beranda" class="btn-nav btn-login" style="display:inline-block; padding:15px 30px;">Mulai Konsultasi &rarr;</a>
            </div>
            <div class="hero-img-wrap">
                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=600" class="hero-img" alt="Dokter Online">
                <div class="float-badge">💬 Chat Aktif 24/7</div>
            </div>
        </div>

        <div style="background: white; border-radius: 24px; padding: 40px; box-shadow: 0 10px 30px rgba(16,95,104,0.05); margin-bottom: 60px; border: 1px solid #eef7f6;">
            <div style="text-align: center; margin-bottom: 30px;">
                <h3 class="section-title" style="justify-content: center; margin-bottom: 10px;">Persentase Keluhan Kesehatan Masyarakat</h3>
                <p style="color: #3a9295; font-size: 1rem; margin-bottom: 15px;">Urgensi kehadiran TeleMedika di berbagai provinsi. (Sumber: BPS)</p>
                
                <select id="pilihProvinsi" style="padding: 10px 15px; border-radius: 8px; border: 2px solid #eef7f6; color: #105f68; font-weight: 600; outline: none; background: #f8fbfb; cursor: pointer;">
                    <option value="semua">Tampilkan Semua Provinsi</option>
                </select>
            </div>
            <div style="position: relative; height: 350px; width: 100%;">
                <canvas id="grafikBPS"></canvas>
            </div>
        </div>

        <script>
            // Arahkan ke file php buatan kita sendiri
            const urlAPI = "/api/api_bps"; 
            
            let myChart = null;
            let dataAsliBPS = [];

            // fungsi render grafik
            function drawChart(lbl, val) {
                if(myChart != null) myChart.destroy();
                const ctx = document.getElementById('grafikBPS').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: lbl,
                        datasets: [{ 
                            label: 'Persentase Keluhan (%)', 
                            data: val, 
                            backgroundColor: '#d9534f', // merah
                            borderRadius: 5 
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } } }
                });
            }

            // isi dropdown otomatis
            function isiMenuDropdown(dataArray) {
                const menu = document.getElementById('pilihProvinsi');
                menu.innerHTML = '<option value="semua">Tampilkan Semua Provinsi</option>';
                dataArray.forEach(d => {
                    menu.innerHTML += `<option value="${d.nama_wilayah}">${d.nama_wilayah}</option>`;
                });
            }

            // SMART PARSER V2: Menyelam ke dalam JSON BPS
            fetch(urlAPI)
                .then(res => res.json())
                .then(json => {
                    let arrayData = [];

                    // STRATEGI MENCARI DATA:
                    // BPS sering menyembunyikan data di dalam properti "data" lagi
                    if (json.data && Array.isArray(json.data)) {
                        // Cari adakah elemen yang punya properti "data" berupa array
                        let objekTersembunyi = json.data.find(item => item.data && Array.isArray(item.data));
                        
                        if (objekTersembunyi) {
                            arrayData = objekTersembunyi.data; // Nah ketemu! Ini array provinsinya
                        } else {
                            // Jika tidak disembunyikan
                            arrayData = json.data.filter(item => item.label && item.variables);
                        }
                    }

                    if(arrayData.length === 0) throw new Error("Data tidak ditemukan di JSON");

                    // Ekstrak nama provinsi dan nilainya
                    dataAsliBPS = arrayData.map(item => {
                        let namaProv = item.label || "Tidak Diketahui";
                        
                        if(item.variables) {
                            let kunciAcak = Object.keys(item.variables)[0];
                            let nilaiString = item.variables[kunciAcak].value; // Format "27,12"
                            
                            // Wajib ubah koma jadi titik agar grafik tidak nge-blank
                            let nilaiAngka = parseFloat(String(nilaiString).replace(',', '.'));
                            return { nama_wilayah: namaProv, nilai: nilaiAngka };
                        }
                        return { nama_wilayah: namaProv, nilai: 0 };
                    });

                    // Tampilkan ke layar
                    const lbl = dataAsliBPS.map(d => d.nama_wilayah);
                    const val = dataAsliBPS.map(d => d.nilai);

                    drawChart(lbl, val);
                    isiMenuDropdown(dataAsliBPS);
                })
                .catch(err => {
                    console.error("Gagal Memproses API:", err);
                    drawChart(["Gagal Membaca Data API BPS"], [0]);
                });

            // filter saat dropdown berubah
            document.getElementById('pilihProvinsi').addEventListener('change', function() {
                const pilihan = this.value;
                if (!pilihan) return;
                
                let dataFilter = (pilihan === 'semua') ? dataAsliBPS : dataAsliBPS.filter(d => d.nama_wilayah === pilihan);
                const lbl = dataFilter.map(d => d.nama_wilayah);
                const val = dataFilter.map(d => d.nilai);
                
                drawChart(lbl, val);
            });
        </script>

        <h3 class="section-title">Chat Dokter Spesialis</h3>
        <div class="chat-grid">
            <div class="doc-card">
                <span class="status">• ONLINE</span>
                <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&q=80&w=200" class="doc-img" alt="Dr Andi">
                <h4 style="color:#105f68;">Dr. Andi Pratama</h4>
                <p style="font-size:0.8rem; color:#3a9295;">Dokter Umum</p>
                <a href="/api/beranda" class="btn-chat">Mulai Chat</a>
            </div>
            <div class="doc-card">
                <span class="status">• ONLINE</span>
                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=600" class="doc-img" alt="Dr Siti">
                <h4 style="color:#105f68;">Dr. Siti Aminah</h4>
                <p style="font-size:0.8rem; color:#3a9295;">Dokter Umum</p>
                <a href="/api/beranda" class="btn-chat">Mulai Chat</a>
            </div>
            <div class="doc-card">
                <span class="status">• ONLINE</span>
                <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&q=80&w=200" class="doc-img" alt="Dr Budi">
                <h4 style="color:#105f68;">Dr. Budi Santoso</h4>
                <p style="font-size:0.8rem; color:#3a9295;">Spesialis Anak</p>
                <a href="/api/beranda" class="btn-chat">Mulai Chat</a>
            </div>
        </div>

        <h3 class="section-title">Jadwal Praktik Dokter</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Spesialisasi</th>
                        <th>Nama Dokter & Jadwal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong style="color:#105f68;">Dokter Umum</strong></td>
                        <td>Dr. Andi Pratama (08:00 - 12:00)<br>Dr. Siti Aminah (13:00 - 17:00)</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong style="color:#105f68;">Spesialis Anak</strong></td>
                        <td>Dr. Budi Santoso (10:00 - 15:00)<br>Dr. Maya Sari (18:00 - 21:00)</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong style="color:#105f68;">Kesehatan Mental</strong></td>
                        <td>Psikolog Rina Wati (09:00 - 16:00)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="section-title">Informasi Seputar Kesehatan</h3>
        <div class="art-grid">
            <a href="#" class="art-card">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=400&q=80" class="art-img" alt="Diet">
                <div class="art-body">
                    <span class="badge">Kesehatan</span>
                    <h4>GLP-1 Jadi Fenomena Baru Obat Penurun Berat Badan</h4>
                    <p class="date">04 Mar 2026</p>
                </div>
            </a>
            <a href="#" class="art-card">
                <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=400&q=80" class="art-img" alt="Obat">
                <div class="art-body">
                    <span class="badge">Kesehatan</span>
                    <h4>Puasa Tapi Harus Minum Obat Rutin? Begini Strateginya</h4>
                    <p class="date">26 Feb 2026</p>
                </div>
            </a>
            <a href="#" class="art-card">
                <img src="https://awsimages.detik.net.id/community/media/visual/2023/06/07/ilustrasi-virus_169.jpeg?w=1200" class="art-img" alt="Virus">
                <div class="art-body">
                    <span class="badge">Kesehatan</span>
                    <h4>Waspada dan Konsultasikan Gejala Meski Virus Nipah Belum Masuk</h4>
                    <p class="date">06 Feb 2026</p>
                </div>
            </a>
        </div>
        
        <div class="center-btn">
            <a href="https://kemkes.go.id/id/category/artikel-kesehatan" class="btn-outline">Lihat Semua Artikel</a>
        </div>

        <h3 class="section-title">Layanan Pendukung</h3>
        <div class="feat-grid">
            <div class="feat-item">
                <div class="icon-circle" style="color:#d9534f;">📞</div>
                <h4>Panggilan Darurat</h4>
                <p>Layanan call center 24 jam untuk bantuan medis mendadak.</p>
            </div>
            <div class="feat-item">
                <div class="icon-circle" style="color:#5cb85c;">📩</div>
                <h4>Kotak Masuk</h4>
                <p>Berbagai promo menarik dari mitra kesehatan untuk Anda.</p>
            </div>
            <div class="feat-item">
                <div class="icon-circle" style="color:#0275d8;">📍</div>
                <h4>Terdekat</h4>
                <p>Cari lokasi rumah sakit, apotek, dan lab di sekitar Anda.</p>
            </div>
            <div class="feat-item">
                <div class="icon-circle" style="color:#f0ad4e;">💡</div>
                <h4>Artikel Sehat</h4>
                <p>Informasi edukatif tentang gaya hidup sehat dan olahraga.</p>
            </div>
        </div>

    </div>

    <div class="footer-wrap">
        <div class="shield-logo">
            <div class="shield-inner">
                <svg fill="white" viewBox="0 0 24 24" style="width:20px;"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                KLINIK
            </div>
        </div>
        <footer class="footer-main">
            <div>
                <h4>Layanan</h4>
                <a href="#">Chat Dokter</a>
                <a href="#">Tebus Resep</a>
            </div>
            <div>
                <h4>Informasi</h4>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Privasi</a>
            </div>
            <div>
                <h4>Bantuan</h4>
                <a href="#">FAQ</a>
                <a href="#">Kontak Kami</a>
            </div>
        </footer>
        <div class="footer-bottom">
            <p>Copyright &copy; 2026 TeleMedika. All rights reserved.</p>
        </div>
    </div>

</body>
</html>