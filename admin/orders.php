<?php
include 'auth_check.php';
include '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>🧾 Daftar Pesanan</h2>
    <a href="index.php" class="btn btn-secondary">Kembali ke Produk</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Total</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
      while ($row = $result->fetch_assoc()) {
      ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
        <td><?= $row['status'] ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
          <a href="order_detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
