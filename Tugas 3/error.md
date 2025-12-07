Bagian 1: Dokumentasi Deteksi Error
Berdasarkan kode mentah yang terdapat dalam dokumen, berikut adalah uraian error yang ditemukan:

1. File: form-daftar.php

Baris 55: <DOCTYPE >.

Jenis Error: Syntax Error (HTML).

Penyebab: Penulisan deklarasi DOCTYPE tidak valid.

Perbaikan: Ubah menjadi <!DOCTYPE html>.


Baris 60: Tag <title> berada di dalam <body>.

Jenis Error: Structure/Semantic Error.

Penyebab: Title seharusnya berada di dalam <head>.

Perbaikan: Pindahkan <title> ke dalam tag <head>.


Baris 68-70: lengkap" /> $</p>$ <p> <input type="text" name="nama" placeholder="nama.

Jenis Error: Syntax Error.

Penyebab: Kesalahan pengetikan (typo) parah yang memotong atribut input dan menambahkan karakter sampah $.

Perbaikan: Bersihkan tag input menjadi <input type="text" name="nama" placeholder="nama lengkap" />.

2. File: proses-pendaftaran-2.php

Baris 108: $nama $=S$ _POST['nama'];.

Jenis Error: Syntax Error.

Penyebab: Typo pada variabel superglobal $_POST dan tanda sama dengan.

Perbaikan: Ubah menjadi $nama = $_POST['nama'];.


Baris 112: sekolah = $_POST['sekolah_asal'];.

Jenis Error: Syntax Error / Undefined Constant.

Penyebab: Kurang tanda $ pada variabel sekolah.

Perbaikan: Ubah menjadi $sekolah = $_POST['sekolah_asal'];.


Baris 115: ... VALUE ('$nama', ....

Jenis Error: SQL Syntax Error.

Penyebab: Keyword SQL yang benar untuk insert jamak/standar adalah VALUES, bukan VALUE (meski VALUE bisa jalan di beberapa versi, VALUES adalah standar umum).

Perbaikan: Ubah menjadi VALUES.


Baris 115-116: Penggunaan variabel langsung dalam query SQL.

Jenis Error: Security Vulnerability (Logic).

Penyebab: Rentan terhadap SQL Injection.


Perbaikan: Harus menggunakan Prepared Statements sesuai instruksi.


Baris 121: header('Location: indek.ph....

Jenis Error: Runtime Error (Broken Link).

Penyebab: Typo pada nama file tujuan (indek.ph).

Perbaikan: Ubah menjadi index.php.

3. File: calon_siswa.sql

Baris 137: CREATE TABLE calon siswa.

Jenis Error: SQL Syntax Error.

Penyebab: Spasi pada nama tabel tidak diizinkan tanpa backticks.

Perbaikan: Ubah menjadi calon_siswa.


Baris 143, 145: jenis kelamin, sekolah asal.

Jenis Error: SQL Syntax Error.

Penyebab: Spasi pada nama kolom.

Perbaikan: Gunakan underscore, misal jenis_kelamin.


Baris 149: AUTO INCREMENT $=13$.

Jenis Error: SQL Syntax Error.

Penyebab: Karakter $ tidak valid di SQL statement ini.

Perbaikan: AUTO_INCREMENT=13.
