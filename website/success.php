<?php
$order_id = $_GET['order_id'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Diterima</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center my-5">
  <h2>🎉 Pesanan Berhasil Dikirim!</h2>
  <p>Nomor Pesanan Anda: <strong>#<?= $order_id ?></strong></p>
  <p>Terima kasih telah berbelanja di <b>Toko Olahraga</b>.</p>
  <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
</body>
</html>
