<?php
include 'koneksi.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id == 0) {
    header("Location: modifikasi_pesanan.php");
    exit;
}
$query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data pesanan tidak ditemukan.'); window.location.href='modifikasi_pesanan.php';</script>";
    exit;
}

$harga_layanan_check = 0;
if ($data['penginapan']) $harga_layanan_check += 1000000;
if ($data['transportasi']) $harga_layanan_check += 1200000;
if ($data['makanan']) $harga_layanan_check += 500000;

$harga_dasar_murni = $data['harga_paket'] - $harga_layanan_check; 
$harga_dasar_murni = max(0, $harga_dasar_murni); 

$harga_dasar_formatted = number_format($harga_dasar_murni, 0, ',', '.');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan ID #<?php echo $id; ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; color: #333; }
        header { background-color: #007bff; color: white; padding: 20px 0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { margin: 0; font-size: 1.8em; }
        nav { margin-top: 10px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        main { padding: 40px 20px; max-width: 800px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #007bff; margin-bottom: 30px; }
        
        /* Gaya Form */
        label { display: block; margin-top: 15px; font-weight: 600; }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; 
        }
        input[readonly] { 
            background-color: #e0f7fa; 
            font-weight: bold; 
            color: #0056b3;
        }
        .form-actions button {
            padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer; margin-top: 20px; font-size: 1em; margin-right: 10px;
        }
        .btn-simpan { background-color: #ffc107; color: #333; } 
        .btn-kembali { background-color: #6c757d; color: white; }
        .btn-simpan:hover { background-color: #e0a800; }
        .btn-kembali:hover { background-color: #5a6268; }
        .info-paket { background-color: #fff3cd; border-left: 5px solid #ffc107; padding: 10px 15px; margin-bottom: 20px; border-radius: 4px; }
        footer { 
            text-align: center; 
            padding: 20px; 
            background-color: #333; 
            color: white; 
            margin-top: 40px; 
            font-size: 0.9em; 
        }
        @media (max-width: 768px) {
            header { padding: 15px 0; }
            h1 { font-size: 1.5em; }
            nav a { margin: 0 10px; display: inline-block; padding: 5px 0; font-size: 0.9em; }
            main { 
                padding: 20px; 
                margin: 20px auto;
                max-width: 95%; 
            }
            footer {
                padding: 15px 10px; 
                font-size: 0.8em;
            }
        }
    </style>
    
    <script>
        function hitungTotal() {
            const hargaPenginapan = 1000000;
            const hargaTransport = 1200000;
            const hargaMakan = 500000;

            const hargaDasarMurni = parseInt(document.getElementById('harga_dasar_murni').value) || 0;

            let biayaLayananTambahan = 0;
            if (document.getElementById('penginapan').checked) biayaLayananTambahan += hargaPenginapan;
            if (document.getElementById('transport').checked) biayaLayananTambahan += hargaTransport;
            if (document.getElementById('makan').checked) biayaLayananTambahan += hargaMakan;

            let hargaPaketTotal = hargaDasarMurni + biayaLayananTambahan;

            const waktu = parseInt(document.getElementById('waktu').value) || 0;
            const peserta = parseInt(document.getElementById('peserta').value) || 0;

            const totalTagihan = waktu * peserta * hargaPaketTotal;

            document.getElementById('harga_paket').value = hargaPaketTotal;
            document.getElementById('total_tagihan').value = totalTagihan;
        }

        function validasiForm(event) {
            const fields = ['nama', 'hp', 'tanggal', 'waktu', 'peserta'];
            let isianLengkap = true;
            
            for (let i = 0; i < fields.length; i++) {
                const element = document.getElementById(fields[i]);
                if (!element.value) {
                    isianLengkap = false;
                    break;
                }
            }
            
            if (!isianLengkap) {
                alert('Peringatan: Semua data wajib diisi, termasuk Waktu Pelaksanaan dan Jumlah Peserta!');
                event.preventDefault(); 
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
    <header>
        <h1>Aplikasi Pengelolaan dan Pemesanan Paket Wisata Pangandaran</h1>
        <nav>
            <a href="index.php">Beranda</a> | 
            <a href="pemesanan.php">Pesan Paket</a> | 
            <a href="modifikasi_pesanan.php">Daftar Pesanan</a>
        </nav>
    </header>

    <main>
        <h2>Edit Pesanan Paket Wisata ID #<?php echo $id; ?></h2>
        
        <div class="info-paket">
            Anda mengedit pesanan paket: *<?php echo htmlspecialchars($data['nama_paket'] ?? 'Tidak Diketahui'); ?>*<br>
            Harga Dasar Paket (Murni, Tanpa Layanan Tambahan): *Rp <span id="harga_dasar_display"><?php echo $harga_dasar_formatted; ?></span>*
        </div>
        
        <form action="proses_edit.php" method="POST" oninput="hitungTotal()" onsubmit="return validasiForm(event)">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" id="harga_dasar_murni" name="harga_dasar_murni" value="<?php echo $harga_dasar_murni; ?>">
            
            <label for="nama_paket_display">Nama Paket:</label>
            <input 
                type="text" 
                id="nama_paket_display" 
                value="<?php echo htmlspecialchars($data['nama_paket'] ?? 'Tidak Diketahui'); ?>" 
                readonly
            >
            <input type="hidden" name="nama_paket" value="<?php echo htmlspecialchars($data['nama_paket'] ?? 'Tidak Diketahui'); ?>">

            <label for="nama">Nama Pemesan:</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama_pemesan']); ?>" required><br>
            
            <label for="hp">Nomor HP/Telp:</label>
            <input type="text" id="hp" name="hp" value="<?php echo htmlspecialchars($data['nomor_hp']); ?>" required><br>

            <label for="tanggal">Tanggal Pesan:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($data['tanggal_pesan']); ?>" required><br>

            <label for="waktu">Waktu Pelaksanaan Perjalanan (Hari):</label>
            <input type="number" id="waktu" name="waktu" min="1" value="<?php echo htmlspecialchars($data['waktu_perjalanan']); ?>" required><br>

            <label for="peserta">Jumlah Peserta:</label>
            <input type="number" id="peserta" name="peserta" min="1" value="<?php echo htmlspecialchars($data['jumlah_peserta']); ?>" required><br>

            <p>Pelayanan Paket Perjalanan (Biaya Tambahan):</p>
            <input type="checkbox" id="penginapan" name="layanan[]" value="penginapan" onchange="hitungTotal()" <?php echo $data['penginapan'] ? 'checked' : ''; ?>> Penginapan (Rp 1.000.000)<br>
            <input type="checkbox" id="transport" name="layanan[]" value="transport" onchange="hitungTotal()" <?php echo $data['transportasi'] ? 'checked' : ''; ?>> Transportasi (Rp 1.200.000)<br>
            <input type="checkbox" id="makan" name="layanan[]" value="makan" onchange="hitungTotal()" <?php echo $data['makanan'] ? 'checked' : ''; ?>> Service/Makan (Rp 500.000)<br><br>

            <label for="harga_paket">Harga Paket Perjalanan:</label>
            <input type="number" id="harga_paket" name="harga_paket" value="<?php echo htmlspecialchars($data['harga_paket']); ?>" readonly><br>

            <label for="total_tagihan">Jumlah Tagihan:</label>
            <input type="number" id="total_tagihan" name="total_tagihan" value="<?php echo htmlspecialchars($data['total_tagihan']); ?>" readonly><br><br>

            <div class="form-actions">
                <button type="submit" class="btn-simpan" name="submit">Simpan Perubahan</button>
                <button type="button" class="btn-kembali" onclick="window.location.href='modifikasi_pesanan.php'">Batal / Kembali</button>
            </div>
        </form>
        <script>
            window.onload = hitungTotal;
        </script> 
    </main>
    
    <footer>
        <p>Proyek Capstone | Aplikasi Wisata Pangandaran | Hak Cipta &copy; 2025</p>
    </footer>
</body>
</html>