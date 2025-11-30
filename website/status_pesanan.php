<?php
session_start();
include 'includes/config.php';

if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['users']['id'];

$result = $conn->query("SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Status Pesanan Saya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
  <h2>📦 Status Pesanan Saya</h2>
  <table class="table table-bordered mt-4">
    <thead class="table-dark">
      <tr>
        <th>ID Pesanan</th>
        <th>Nama</th>
        <th>Total</th>
        <th>Status</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td><?= $row['created_at'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
</div>
</body>
</html>