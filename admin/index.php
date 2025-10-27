<?php
include 'auth_check.php';
include '../includes/config.php';

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Data Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
  <h2>📦 Data Produk</h2>
  <div>
    <a href="orders.php" class="btn btn-success me-2">Status Pemesenan</a>
    <a href="add_product.php" class="btn btn-success me-2">+ Tambah Produk</a>
    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
  </div>
</div>

  </div>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Ukuran</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
      while ($row = $result->fetch_assoc()) {
      ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['category'] ?></td>
        <td>Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
        <td><?= $row['ukuran'] ?></td>
         <td><?= $row['stok'] ?></td>
        <td><img src="../uploads/<?= $row['image'] ?>" width="60"></td>
        <td>
          <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="delete_product.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
