# Dokumentasi Deteksi dan Perbaikan Error

Berikut adalah hasil analisis terhadap error yang ditemukan pada program pendaftaran siswa.

---

## 1️⃣ Error pada form-daftar.php
Terdapat kesalahan penulisan deklarasi HTML di bagian paling atas:

<DOCTYPE>

Kode tersebut tidak valid dan mengakibatkan browser tidak membaca struktur HTML secara benar.

✔ Solusi:
<!DOCTYPE html>

---

## 2️⃣ Error pada proses-pendaftaran-2.php (Variabel)
Kesalahan penulisan variabel input sekolah:

sekolah = $_POST['sekolah_asal'];

Variabel PHP wajib diawali simbol `$`. Jika tidak, akan menyebabkan *Parse Error* dan data tidak tersimpan.

✔ Solusi:
$sekolah = $_POST['sekolah_asal'];

---

## 3️⃣ Kesalahan Query SQL
Sintaks query menggunakan:

VALUE (...)

Padahal yang benar adalah:

VALUES (...)

Jika tidak diperbaiki, query INSERT akan gagal dieksekusi.

✔ Solusi:
VALUES (...)

---

## 4️⃣ Kesalahan Redirect (Typo)
Pada kondisi gagal simpan data tertulis:

header('Location: indek.php?status=gagal');

Penulisan nama file salah sehingga redirect menuju halaman yang tidak ada.

✔ Solusi:
header('Location: index.php?status=gagal');

---

## 5️⃣ Masalah Keamanan Query SQL (SQL Injection)
Kode awal menggunakan query SQL dengan data langsung dari input pengguna:

'... $nama ...'

Teknik tersebut rentan SQL Injection.

✔ Solusi yang diterapkan:
Menggunakan Prepared Statements:
mysqli_prepare() dan mysqli_stmt_bind_param()

---

## 6️⃣ Potensi Error pada Koneksi Database
Password database pada koneksi.php ditulis:

$password = "12345";

Pada sebagian besar server lokal (seperti XAMPP), password default MySQL kosong,
sehingga koneksi dapat gagal.

✔ Solusi:
$password = "";

---

## Kesimpulan
Error yang ditemukan terdiri dari:
- Syntax error
- Query SQL error
- Typo pada redirect
- Kelemahan keamanan
- Konfigurasi database tidak universal

Semua error tersebut sudah diperbaiki dalam versi kode final yang digunakan.

---
