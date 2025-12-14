<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Pangandaran - Beranda</title>
    
    <style>
       
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; color: #333; }
        header { background-color: #007bff; color: white; padding: 20px 0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { margin: 0; font-size: 1.8em; }
        nav { margin-top: 10px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        main { padding: 40px 20px; max-width: 1300px; margin: 0 auto; }
        h2 { text-align: center; color: #007bff; margin-bottom: 30px; }
        .package-list { display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; }
        .package-item { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); width: 320px; text-align: center; transition: transform 0.3s; }
        .package-item img { max-width: 100%; height: auto; border-radius: 6px; margin-bottom: 15px; border: 1px solid #ddd; }
        .package-item h3 { color: #0056b3; margin-top: 0; }
        .package-item .deskripsi { font-size: 0.9em; color: #555; margin-bottom: 10px; min-height: 50px; }
        .youtube-link { display: block; margin-bottom: 15px; color: #dc3545; font-weight: bold; text-decoration: none; }
        .btn { display: inline-block; background-color: #28a745; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; margin-top: 10px; font-weight: bold; transition: background-color 0.3s; }
        footer { text-align: center; padding: 15px; background-color: #333; color: white; margin-top: 40px; font-size: 0.9em; }

       
        @media (max-width: 768px) {
            header { padding: 15px 0; }
            h1 { font-size: 1.5em; }
            nav a { margin: 0 10px; display: inline-block; padding: 5px 0; font-size: 0.9em; }
            
            .package-list { 
                flex-direction: column; 
                align-items: center; 
            }
            .package-item { 
                width: 90%; 
                max-width: 400px; 
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
        <h2>Destinasi Pilihan: Paket Wisata Pangandaran</h2>
        
        <div class="package-list">
            
            <div class="package-item">
                <img src="img/pantai pangandaran.jpg" alt="Pantai Pangandaran">
                <h3>Paket Exotic Pangandaran (3H2M)</h3>
                <p class="deskripsi">Paket lengkap menikmati pantai, sunset, dan mengunjungi Cagar Alam Pananjung. Cocok untuk liburan keluarga.</p>
                <p>Harga Dasar: *Rp 500.000*</p>
                <a href="https://www.youtube.com/watch?v=eK-26RqYYqE" target="_blank" class="youtube-link">🎬 Tonton Video Promosi Pantai</a>
                <a href="pemesanan.php?harga_dasar=500000&nama_paket=Exotic Pangandaran" class="btn">Pesan Paket Ini</a>
            </div>

            <div class="package-item">
                <img src="img/green canyon.jpg" alt="Green Canyon">
                <h3>Body Rafting Green Canyon (1 Hari)</h3>
                <p class="deskripsi">Petualangan arung jeram dengan tubuh menyusuri sungai Citumang/Green Canyon diapit tebing-tebing indah.</p>
                <p>Harga Dasar: *Rp 350.000*</p>
                <a href="https://www.youtube.com/watch?v=-S7wCNf0-qk" target="_blank" class="youtube-link">🎬 Tonton Video Promosi Body Rafting</a>
                <a href="pemesanan.php?harga_dasar=350000&nama_paket=Body Rafting Green Canyon" class="btn">Pesan Paket Ini</a>
            </div>

            <div class="package-item">
                <img src="img/batu karas.jpg" alt="Batu Karas">
                <h3>Paket Surfing & Santai Batu Karas</h3>
                <p class="deskripsi">Menawarkan ombak yang tenang, ideal untuk pemula yang ingin belajar surfing. Suasana pantai yang lebih privat.</p>
                <p>Harga Dasar: *Rp 450.000*</p>
                <a href="https://youtu.be/r094vTxdn8o?si=ny1r7GgaiHLj6xdz" target="_blank" class="youtube-link">🎬 Tonton Video Promosi Batu Karas</a>
                <a href="pemesanan.php?harga_dasar=450000&nama_paket=Surfing Batu Karas" class="btn">Pesan Paket Ini</a>
            </div>

        </div>
    </main>
    
    <footer>
        <p>Proyek Capstone | Aplikasi Wisata Pangandaran| Hak Cipta &copy; 2025</p>
    </footer>
</body>
</html>