<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Wisata UMKM</title>
    <style>
        
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; color: #333; }
        header { background-color: #007bff; color: white; padding: 20px 0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { margin: 0; font-size: 1.8em; }
        nav { margin-top: 10px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        main { padding: 40px 20px; max-width: 1300px; margin: 0 auto; }
        h2 { text-align: center; color: #007bff; margin-bottom: 30px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; font-size: 0.9em; }
        th { background-color: #007bff; color: white; font-weight: 600; }
        tr:nth-child(even) { background-color: #f8f8f8; }
        
        td a { 
            text-decoration: none; 
            margin-right: 5px; 
            padding: 6px 10px; 
            border-radius: 4px; 
            font-weight: 500; 
            display: inline-block; 
        }
        .btn-edit {
            background-color: #ffc107; 
            color: #333; 
            border: 1px solid #e0a800;
        }
        .btn-edit:hover {
            background-color: #e0a800;
        }
        .btn-hapus {
            margin-right: 0;
            background-color: #dc3545; 
            color: white; 
            border: 1px solid #c82333;
        }
        .btn-hapus:hover {
            background-color: #c82333;
        }
        
        .btn-back { display: inline-block; background-color: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-top: 20px; }

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
            main { padding: 20px 10px; }

            
            .table-container {
                overflow-x: auto; 
                width: 100%;
            }
            table {
                
                min-width: 900px; 
            }
            th, td {
                padding: 8px 10px;
            }

            footer {
                padding: 15px 0; 
                font-size: 0.8em;
            }
        }
    </style>
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
        <h2>Daftar Pesanan Paket Wisata</h2>
        
        <div class="table-container">
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>HP</th>
                    <th>Tanggal Pesan</th>
                    <th>Waktu (Hari)</th>
                    <th>Peserta</th>
                    <th>Layanan</th>
                    <th>Harga Paket / Peserta</th>
                    <th>Total Tagihan</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC");
                while ($data = mysqli_fetch_array($query)) {
                    $layanan_str = [];
                    if ($data['penginapan']) $layanan_str[] = 'Penginapan';
                    if ($data['transportasi']) $layanan_str[] = 'Transportasi';
                    if ($data['makanan']) $layanan_str[] = 'Makan';

                    echo "<tr>
                        <td>{$data['id']}</td>
                        <td>{$data['nama_pemesan']}</td>
                        <td>{$data['nomor_hp']}</td>
                        <td>{$data['tanggal_pesan']}</td>
                        <td>{$data['waktu_perjalanan']}</td>
                        <td>{$data['jumlah_peserta']}</td>
                        <td>" . (empty($layanan_str) ? 'Tanpa Layanan' : implode(", ", $layanan_str)) . "</td>
                        <td>Rp " . number_format($data['harga_paket'], 0, ',', '.') . "</td>
                        <td>Rp " . number_format($data['total_tagihan'], 0, ',', '.') . "</td>
                        <td>
                            <a href='edit_pesanan.php?id={$data['id']}' class='btn-edit'>Edit</a> 
                            <a href='proses_hapus.php?id={$data['id']}' class='btn-hapus' onclick='return confirm(\"Yakin ingin menghapus pesanan ini? Aksi ini tidak dapat dibatalkan.\")'>Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
        
        <a href="index.php" class="btn-back">Kembali ke Beranda</a>
    </main>
    
   <footer>
        <p>Proyek Capstone | Aplikasi Wisata Pangandaran | Hak Cipta &copy; 2025</p>
    </footer>
</body>
</html>