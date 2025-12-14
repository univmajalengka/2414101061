<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id']; 
    
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $tgl = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $waktu = (int)$_POST['waktu'];
    $peserta = (int)$_POST['peserta'];
    $harga = (int)$_POST['harga_paket'];
    $total = (int)$_POST['total_tagihan'];
    $nama_paket = mysqli_real_escape_string($conn, $_POST['nama_paket']); 
    $layanan = $_POST['layanan'] ?? [];
    $penginapan = in_array('penginapan', $layanan) ? 1 : 0;
    $transport = in_array('transport', $layanan) ? 1 : 0;
    $makan = in_array('makan', $layanan) ? 1 : 0;
    $sql = "UPDATE pesanan SET 
                nama_pemesan = '$nama', 
                nomor_hp = '$hp', 
                tanggal_pesan = '$tgl', 
                waktu_perjalanan = $waktu, 
                jumlah_peserta = $peserta, 
                penginapan = $penginapan, 
                transportasi = $transport, 
                makanan = $makan, 
                harga_paket = $harga, 
                total_tagihan = $total,
                nama_paket = '$nama_paket'
            WHERE id = $id"; 

    if (mysqli_query($conn, $sql)) {
        
        header("Location: modifikasi_pesanan.php"); 
        exit;
    } else {
        
        echo "Error saat mengupdate data. Pastikan kolom di database sudah benar: " . mysqli_error($conn);
    }
} else {
    header("Location: modifikasi_pesanan.php");
    exit;
}
?>