CREATE DATABASE wisata_pangandaran;
USE wisata_pangandaran;

CREATE TABLE pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemesan VARCHAR(100) NOT NULL,
    nomor_hp VARCHAR(15) NOT NULL,
    tanggal_pesan DATE NOT NULL,
    waktu_perjalanan INT NOT NULL,
    jumlah_peserta INT NOT NULL,
    penginapan BOOLEAN DEFAULT 0,
    transportasi BOOLEAN DEFAULT 0,
    makanan BOOLEAN DEFAULT 0,
    harga_paket DECIMAL(15, 2) NOT NULL,
    total_tagihan DECIMAL(15, 2) NOT NULL,
    nama_paket VARCHAR(100)NOT NULL
);