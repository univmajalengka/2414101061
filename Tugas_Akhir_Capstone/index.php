<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Wisata Pangandaran</title>
    <style>
        /* Mengaktifkan Animasi Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f0f2f5; color: #333; }
        header { background-color: #007bff; color: white; padding: 20px 0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { margin: 0; font-size: 1.8em; }
        nav { margin-top: 10px; }
        nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        nav a:hover { color: #ccc; }
        main { padding: 40px 20px; max-width: 1200px; margin: 0 auto; }
        h2 { text-align: center; color: #007bff; margin-bottom: 30px; }
        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        .package-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }
        .package-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .package-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        .package-content {
            padding: 20px;
        }
        .package-content h3 {
            color: #007bff;
            margin-top: 0;
            font-size: 1.5em;
        }
        .package-content p {
            font-size: 0.95em;
            line-height: 1.6;
            color: #555;
            margin-bottom: 15px;
        }
        .package-price {
            font-size: 1.3em;
            font-weight: 700;
            color: #28a745; /* Hijau */
            margin-bottom: 15px;
        }
        
        /* Gaya untuk link YouTube */
        .package-card .youtube-link {
            display: block; 
            background-color: #f0f7ff; 
            color: #007bff;
            border: 1px solid #007bff;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 10px; 
            transition: background-color 0.3s ease;
        }

        .package-card .youtube-link:hover {
            background-color: #e6f0ff;
        }

        .package-card .btn-pesan {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
            margin-top: 5px; 
        }
        .package-card .btn-pesan:hover {
            background-color: #0056b3;
        }
        
        /* Gaya Galeri Foto */
        .gallery-section {
            margin-top: 60px;
            padding: 30px 0;
            text-align: center;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        /* Gaya Tombol Galeri */
        .btn-gallery {
            display: inline-block;
            background-color: #ffc107; /* Kuning */
            color: #333;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px; /* Jarak dari grid gambar di bawahnya */
            border: 1px solid #e0a800;
            transition: background-color 0.3s ease;
        }

        .btn-gallery:hover {
            background-color: #e0a800;
            color: white;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 15px;
            margin-top: 30px;
            padding: 0 20px;
        }

        .gallery-item img {
            width: 100%;
            height: 150px; 
            object-fit: cover; 
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .gallery-item img:hover {
            transform: scale(1.05); 
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
        footer p { margin: 0; }

        /* Gaya Banner */
        .banner {
            width: 100%;
            height: 300px; 
            background-image: url('img/pantai1.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
            margin-top: 20px; 
            border-radius: 8px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7); 
            text-align: center;
        }

        .banner h2 {
            font-size: 2.8em; 
            margin: 0;
            padding: 0 20px;
            color: white; 
        }

        @media (max-width: 768px) {
            header { padding: 15px 0; }
            h1 { font-size: 1.5em; }
            nav a { margin: 0 10px; display: inline-block; padding: 5px 0; font-size: 0.9em; }
            main { padding: 20px; }
            .package-grid {
                grid-template-columns: 1fr; 
            }
            .package-card img { height: 180px; }

            /* Responsif untuk Banner */
            .banner {
                height: 200px; 
                margin-top: 15px;
            }
            .banner h2 {
                font-size: 1.8em; 
            }
            
            /* Responsif Galeri */
            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
            .gallery-item img {
                height: 100px;
            }

            footer { padding: 15px 0; font-size: 0.8em; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Aplikasi Pengelolaan dan Pemesanan Paket Wisata Pangandaran</h1>
        <nav>
            <a href="index.php">Beranda</a> | 
            <a href="#section-paket">Paket</a> | <a href="pemesanan.php">Pesan Paket</a> | 
            <a href="#section-galeri">Galeri</a> | 
            <a href="modifikasi_pesanan.php">Daftar Pesanan</a>
        </nav>
    </header>

    <main>
        <div class="banner">
            <h2>Selamat Datang di Wisata Pangandaran!</h2>
        </div>

        <h2 id="section-paket">Paket Wisata Unggulan</h2> 
        <div class="package-grid">
            <div class="package-card">
                <img src="img/pantai pangandaran.jpg" alt="Exotic Pangandaran">
                <div class="package-content">
                    <h3>Exotic Pangandaran</h3>
                    <p>Nikmati keindahan pantai Pangandaran, pasir putih, dan ombak yang menenangkan.</p>
                    <div class="package-price">Rp 500.000</div>
                    <a href="https://www.youtube.com/watch?v=eK-26RqYYqE" target="_blank" class="youtube-link">🎬 Tonton Video Promosi Pantai</a>
                    <a href="pemesanan.php?nama_paket=Exotic Pangandaran&harga_dasar=500000" class="btn-pesan">Pesan Paket Ini</a>
                </div>
            </div>

            <div class="package-card">
                <img src="img/green canyon.jpg" alt="Body Rafting Green Canyon">
                <div class="package-content">
                    <h3>Body Rafting Green Canyon</h3>
                    <p>Rasakan petualangan seru body rafting menyusuri sungai Green Canyon yang memukau.</p>
                    <div class="package-price">Rp 350.000</div>
                    <a href="https://www.youtube.com/watch?v=-S7wCNf0-qk" target="_blank" class="youtube-link">🎬 Tonton Video Promosi Body Rafting</a>
                    <a href="pemesanan.php?nama_paket=Body Rafting Green Canyon&harga_dasar=350000" class="btn-pesan">Pesan Paket Ini</a>
                </div>
            </div>

            <div class="package-card">
                <img src="img/batu karas.jpg" alt="Surfing Batu Karas">
                <div class="package-content">
                    <h3>Surfing Batu Karas</h3>
                    <p>Taklukkan ombak di pantai Batu Karas, spot favorit para peselancar.</p>
                    <div class="package-price">Rp 450.000</div>
                    <a href="https://youtu.be/r094vTxdn8o?si=ny1r7GgaiHLj6xdz" target="_blank" class="youtube-link">🎬 Tonton Video Promosi Batu Karas</a>
                    <a href="pemesanan.php?nama_paket=Surfing Batu Karas&harga_dasar=450000" class="btn-pesan">Pesan Paket Ini</a>
                </div>
            </div>
        </div>
        
        <div class="gallery-section" id="section-galeri">
            <h2>Galeri Wisata Pangandaran</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="img/galeri1.jpg" alt="Foto Wisata 1">
                </div>
                <div class="gallery-item">
                    <img src="img/galeri2.jpg" alt="Foto Wisata 2">
                </div>
                <div class="gallery-item">
                    <img src="img/galeri3.jpg" alt="Foto Wisata 3">
                </div>
                <div class="gallery-item">
                    <img src="img/galeri4.jpg" alt="Foto Wisata 4">
                </div>
                <div class="gallery-item">
                    <img src="img/galeri5.jpg" alt="Foto Wisata 5">
                </div>
            </div>
        </div>

    </main>

    <footer>
        <p>Proyek Capstone | Aplikasi Wisata Pangandaran | Hak Cipta &copy; 2025</p>
    </footer>
</body>
</html>
