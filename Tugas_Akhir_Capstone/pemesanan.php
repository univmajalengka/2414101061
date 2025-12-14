<?php
$harga_dasar = isset($_GET['harga_dasar']) ? (int)$_GET['harga_dasar'] : 0;
$nama_paket = isset($_GET['nama_paket']) ? htmlspecialchars($_GET['nama_paket']) : '';

$is_readonly = ($harga_dasar > 0) ? 'readonly' : '';

$harga_dasar_formatted = number_format($harga_dasar, 0, ',', '.');

$packages = [
    'Exotic Pangandaran' => 500000,
    'Body Rafting Green Canyon' => 350000,
    'Surfing Batu Karas' => 450000
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Paket Wisata</title>
    <style>
       
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; color: #333; }
        header { background-color: #007bff; color: white; padding: 20px 0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { margin: 0; font-size: 1.8em; }
        nav { margin-top: 10px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        main { padding: 40px 20px; max-width: 800px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #007bff; margin-bottom: 30px; }
        
        
        label { display: block; margin-top: 15px; font-weight: 600; }
        input[type="text"], input[type="date"], input[type="number"], select {
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
        .btn-simpan { background-color: #28a745; color: white; }
        .btn-kembali { background-color: #6c757d; color: white; }
        .btn-simpan:hover { background-color: #218838; }
        .btn-kembali:hover { background-color: #5a6268; }
        
      
        .info-paket { 
            background-color: #e9f5ff; 
            border-left: 5px solid #007bff; 
            padding: 10px 15px; 
            margin-bottom: 20px; 
            border-radius: 4px; 
        }
        
    
        footer { 
            text-align: center; 
            padding: 20px 0; 
            background-color: #333; 
            color: white; 
            margin-top: 40px; 
            font-size: 0.9em; 
            width: 100%; 
            box-sizing: border-box; 
        }

        footer p {
            margin: 0; 
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
                padding: 15px 0; 
                font-size: 0.8em;
            }
        }
    </style>
    
    <script>
        
        const packagePrices = {
            'Exotic Pangandaran': 500000,
            'Body Rafting Green Canyon': 350000,
            'Surfing Batu Karas': 450000
        };
        
        function updatePackagePrice(selectedPackageName) {
            const newPrice = packagePrices[selectedPackageName] || 0;
            
            document.getElementById('harga_dasar_paket').value = newPrice;
            const formattedPrice = newPrice.toLocaleString('id-ID', { minimumFractionDigits: 0 });
            document.getElementById('harga_dasar_display').textContent = formattedPrice;

            hitungTotal();
        }

        function hitungTotal() {
            const hargaPenginapan = 1000000; 
            const hargaTransport = 1200000; 
            const hargaMakan = 500000;   
            
            const hargaDasar = parseInt(document.getElementById('harga_dasar_paket').value) || 0;

            let biayaLayananTambahan = 0;
            if (document.getElementById('penginapan').checked) biayaLayananTambahan += hargaPenginapan;
            if (document.getElementById('transport').checked) biayaLayananTambahan += hargaTransport;
            if (document.getElementById('makan').checked) biayaLayananTambahan += hargaMakan;

            let hargaPaketTotal = hargaDasar + biayaLayananTambahan;

            const waktu = parseInt(document.getElementById('waktu').value) || 0;
            const peserta = parseInt(document.getElementById('peserta').value) || 0;

            const totalTagihan = waktu * peserta * hargaPaketTotal;

            document.getElementById('harga_paket').value = hargaPaketTotal;
            document.getElementById('total_tagihan').value = totalTagihan;
        }

        function validasiForm(event) {
            let selectedPackage = '';
            const selectElement = document.getElementById('nama_paket_select');
            const inputElement = document.getElementById('nama_paket_input');

            if (selectElement) {
                selectedPackage = selectElement.value;
            } else if (inputElement) {
                selectedPackage = inputElement.value;
            }

            if (!selectedPackage || selectedPackage === 'Pilih Paket') {
                alert('Peringatan: Harap pilih atau isi Nama Paket yang ingin dipesan!');
                event.preventDefault(); 
                return false;
            }
            
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
        <h2>Form Pemesanan Paket Wisata</h2>
        <div class="info-paket">
            Informasi Harga Dasar Paket: <br>
            Harga Dasar Awal: *Rp <span id="harga_dasar_display"><?php echo $harga_dasar_formatted; ?></span>*
        </div>
        
        <form action="proses_pesan.php" method="POST" oninput="hitungTotal()" onsubmit="return validasiForm(event)">
            <input type="hidden" id="harga_dasar_paket" name="harga_dasar_paket" value="<?php echo $harga_dasar; ?>">
            
            <label for="nama_paket_input">Nama Paket yang Dipesan:</label>
            <?php if ($harga_dasar > 0): ?>
                <input 
                    type="text" 
                    id="nama_paket_input" 
                    value="<?php echo $nama_paket; ?>" 
                    readonly
                >
                <input type="hidden" name="nama_paket" value="<?php echo $nama_paket; ?>">
            <?php else:  ?>
                <select 
                    id="nama_paket_select" 
                    name="nama_paket" 
                    onchange="updatePackagePrice(this.value)" 
                    required
                >
                    <option value="Pilih Paket">Pilih Paket</option>
                    <?php foreach ($packages as $name => $price): ?>
                        <option 
                            value="<?php echo htmlspecialchars($name); ?>" 
                        >
                            <?php echo htmlspecialchars($name); ?> (Rp <?php echo number_format($price, 0, ',', '.'); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

            <label for="nama">Nama Pemesan:</label>
            <input type="text" id="nama" name="nama" required><br>
            
            <label for="hp">Nomor HP/Telp:</label>
            <input type="text" id="hp" name="hp" required><br>

            <label for="tanggal">Tanggal Pesan:</label>
            <input type="date" id="tanggal" name="tanggal" required><br>

            <label for="waktu">Waktu Pelaksanaan Perjalanan (Hari):</label>
            <input type="number" id="waktu" name="waktu" min="1" required><br>

            <label for="peserta">Jumlah Peserta:</label>
            <input type="number" id="peserta" name="peserta" min="1" required><br>

            <p>Pelayanan Paket Perjalanan (Biaya Tambahan):</p>
            <input type="checkbox" id="penginapan" name="layanan[]" value="penginapan"> Penginapan (Rp 1.000.000)<br>
            <input type="checkbox" id="transport" name="layanan[]" value="transport"> Transportasi (Rp 1.200.000)<br>
            <input type="checkbox" id="makan" name="layanan[]" value="makan"> Service/Makan (Rp 500.000)<br><br>

            <label for="harga_paket">Harga Paket Perjalanan:</label>
            <input type="number" id="harga_paket" name="harga_paket" readonly><br>

            <label for="total_tagihan">Jumlah Tagihan:</label>
            <input type="number" id="total_tagihan" name="total_tagihan" readonly><br><br>

            <div class="form-actions">
                <button type="submit" class="btn-simpan" name="submit">Simpan</button>
                <button type="button" class="btn-kembali" onclick="window.location.href='index.php'">Kembali</button>
            </div>
        </form>
        <script>window.onload = hitungTotal;</script> 
    </main>
    
    <footer>
        <p>Proyek Capstone | Aplikasi Wisata Pangandaran | Hak Cipta &copy; 2025</p>
    </footer>
</body>
</html>