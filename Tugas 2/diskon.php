<?php

// Fungsi untuk menghitung diskon
function hitungDiskon($totalBelanja) {
    if ($totalBelanja >= 100000) {
        $diskon = $totalBelanja * 0.10;
    } elseif ($totalBelanja >= 50000) {
        $diskon = $totalBelanja * 0.05;
    } else {
        $diskon = 0;
    }

    return $diskon;
}

// Contoh total belanja
$totalBelanja = 120000;

// Hitung diskon
$diskon = hitungDiskon($totalBelanja);

// Hitung total bayar
$totalBayar = $totalBelanja - $diskon;

// Tampilkan hasil
echo "Total Belanja : Rp " . number_format($totalBelanja, 0, ',', '.') . "<br>";
echo "Diskon        : Rp " . number_format($diskon, 0, ',', '.') . "<br>";
echo "Total Bayar   : Rp " . number_format($totalBayar, 0, ',', '.') . "<br>";

?>