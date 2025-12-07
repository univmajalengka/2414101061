# Dokumentasi Deteksi dan Analisis Error

Dokumen ini berisi uraian lengkap mengenai error yang teridentifikasi pada kode program PHP dan script SQL, mencakup jenis error, lokasi, penyebab, dan cara perbaikannya.

---

## 1. File: form-daftar.php

| No. | Pesan Error / Gejala | Jenis Error | Letak File & Baris | Penyebab Error | Cara Memperbaiki |
| :---: | :--- | :--- | :--- | :--- | :--- |
| 1 | [cite_start]Deklarasi HTML tidak valid (<DOCTYPE >)[cite: 55]. | Syntax Error (HTML) | Baris 55 | Penulisan deklarasi DOCTYPE tidak benar. | [cite_start]Ubah menjadi <!DOCTYPE html>[cite: 55]. |
| 2 | [cite_start]Tag <title> berada di dalam <body>[cite: 60]. | Structure/Semantic Error | Baris 60 | Tag title seharusnya diletakkan di dalam tag <head>. | [cite_start]Pindahkan <title>...</title> ke dalam tag <head>[cite: 57, 58, 60]. |
| 3 | [cite_start]Terdapat karakter dan sintaks acak yang merusak tag input[cite: 68, 69]. | Syntax Error (HTML) | Baris 68-70 | Adanya karakter sisa ($</p>$) dan pemotongan atribut placeholder pada tag <input>. | [cite_start]Hapus karakter acak dan satukan tag <input>[cite: 68, 69]. |

---

## 2. File: proses-pendaftaran-2.php

| No. | Pesan Error / Gejala | Jenis Error | Letak File & Baris | Penyebab Error | Cara Memperbaiki |
| :---: | :--- | :--- | :--- | :--- | :--- |
| 1 | Parse error: syntax error, unexpected '...' | Syntax Error (PHP) | Baris 108 | [cite_start]Kesalahan pengetikan (typo) saat mendefinisikan variabel superglobal: $nama $=S$ _POST...[cite: 108]. | Ubah menjadi $nama = $_POST['nama'];[cite: 108]. |
| 2 | Parse error: syntax error, unexpected '=' | Syntax Error (PHP) / Undefined Constant | Baris 112 | [cite_start]Variabel $sekolah tidak didefinisikan dengan tanda dollar ($)[cite: 112]. | [cite_start]Ubah menjadi $sekolah = $_POST['sekolah_asal'];[cite: 112]. |
| 3 | Query tidak dijalankan atau gagal karena kata kunci SQL. | SQL Syntax Error | Baris 115 | [cite_start]Menggunakan kata kunci VALUE yang tidak umum atau mungkin tidak didukung, seharusnya VALUES[cite: 115]. | [cite_start]Ubah VALUE menjadi VALUES dalam query INSERT[cite: 115]. |
| 4 | [cite_start]Kerentanan terhadap serangan SQL Injection[cite: 6]. | Security Vulnerability (Logic) | Baris 115-116 | [cite_start]Penggunaan variabel PHP langsung ('$nama') dalam string query SQL tanpa sanitasi[cite: 115]. | [cite_start]*Implementasi Best Practices:* Ganti mysqli_query dengan *Prepared Statements* (mysqli_stmt_prepare) untuk memisahkan logika query dan data[cite: 24]. |
| 5 | Gagal melakukan redirect ketika menyimpan gagal. | Runtime Error (Logic) | Baris 121 | [cite_start]Kesalahan pengetikan pada nama file tujuan (indek.ph)[cite: 121]. | [cite_start]Ubah menjadi header('Location: index.php?status=gagal');[cite: 121]. |

---

## 3. Script: calon_siswa.sql

| No. | Pesan Error / Gejala | Jenis Error | Letak File & Baris | Penyebab Error | Cara Memperbaiki |
| :---: | :--- | :--- | :--- | :--- | :--- |
| 1 | Error saat menjalankan CREATE TABLE. | SQL Syntax Error | Baris 137, 143, 145 | [cite_start]Nama tabel (calon siswa) dan nama kolom (jenis kelamin, sekolah asal) mengandung spasi yang menyebabkan error tanpa backticks[cite: 137, 143, 145]. | [cite_start]Ganti spasi dengan underscore (_), misalnya calon_siswa[cite: 137, 143, 145]. |
| 2 | Error saat mendefinisikan kolom id dan properti tabel. | SQL Syntax Error | Baris 139, 149 | [cite_start]Penggunaan spasi pada AUTO INCREMENT dan adanya karakter non-SQL ($)[cite: 139, 149]. | [cite_start]Ganti menjadi AUTO_INCREMENT dan hilangkan karakter $, misalnya AUTO_INCREMENT=13[cite: 139, 149]. |
