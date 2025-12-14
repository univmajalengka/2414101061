<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $hp = $_POST['hp'];
    $tgl = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $peserta = $_POST['peserta'];
    $harga = $_POST['harga_paket'];
    $total = $_POST['total_tagihan'];
    $nama_paket = $_POST['nama_paket']; 
    $layanan = $_POST['layanan'] ?? [];
    $penginapan = in_array('penginapan', $layanan) ? 1 : 0;
    $transport = in_array('transport', $layanan) ? 1 : 0;
    $makan = in_array('makan', $layanan) ? 1 : 0;
    $sql = "INSERT INTO pesanan (nama_pemesan, nomor_hp, tanggal_pesan, waktu_perjalanan, jumlah_peserta, penginapan, transportasi, makanan, harga_paket, total_tagihan, nama_paket) 
            VALUES ('$nama', '$hp', '$tgl', $waktu, $peserta, $penginapan, $transport, $makan, $harga, $total, '$nama_paket')";

    if (mysqli_query($conn, $sql)) {
        header("Location: modifikasi_pesanan.php"); 
        exit;
    } else {
        echo "Error saat menyimpan data: " . mysqli_error($conn);
    }
}
?>