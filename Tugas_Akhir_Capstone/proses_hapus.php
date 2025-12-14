<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM pesanan WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: modifikasi_pesanan.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: modifikasi_pesanan.php");
}
?>