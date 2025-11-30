<?php
include '../includes/config.php';

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $ukuran = $_POST['ukuran'];
  $stok = $_POST['stok'];

  // Upload gambar
  $image = $_FILES['image']['name'];
  $target = "../uploads/" . basename($image);
  move_uploaded_file($_FILES['image']['tmp_name'], $target);

  $conn->query("INSERT INTO products (name, category, price, image, ukuran, stok)
                VALUES ('$name', '$category', '$price', '$image', '$ukuran', '$stok')");
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container my-5">
    <h2 class="mb-4">Tambah Produk</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Kategori</label>
        <select name="category" class="form-select">
          <option value="Jersey">Jersey</option>
          <option value="Sepatu">Sepatu</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="ukuran" class="form-label">Ukuran</label>
        <input type="text" name="ukuran" class="form-control" id="ukuran" placeholder="Contoh: S, M, L, XL">
      </div>
      <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Gambar Produk</label>
        <input type="file" name="image" class="form-control" required>
      </div>
      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>

</body>

</html>