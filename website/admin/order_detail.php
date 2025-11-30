<?php
include 'auth_check.php';
include '../includes/config.php';
$id = $_GET['id'];
$order = $conn->query("SELECT * FROM orders WHERE id=$id")->fetch_assoc();

if (isset($_POST['update_status'])) {
  $status = $_POST['status'];
  $conn->query("UPDATE orders SET status='$status' WHERE id=$id");
  header("Location: orders.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
  <h3>Detail Pesanan #<?= $order['id'] ?></h3>
  <p><strong>Nama:</strong> <?= $order['name'] ?></p>
  <p><strong>Email:</strong> <?= $order['email'] ?></p>
  <p><strong>Telepon:</strong> <?= $order['phone'] ?></p>
  <p><strong>Alamat:</strong> <?= $order['address'] ?></p>
  <p><strong>Total:</strong> Rp<?= number_format($order['total'], 0, ',', '.') ?></p>

  <form method="POST" class="mb-3">
    <label>Status Pesanan:</label>
    <select name="status" class="form-select w-50 mb-2">
      <option <?= $order['status']=='Menunggu Pembayaran'?'selected':'' ?>>Menunggu Pembayaran</option>
      <option <?= $order['status']=='Dikirim'?'selected':'' ?>>Dikirim</option>
      <option <?= $order['status']=='Selesai'?'selected':'' ?>>Selesai</option>
    </select>
    <button type="submit" name="update_status" class="btn btn-primary">Perbarui Status</button>
    <a href="orders.php" class="btn btn-secondary">Kembali</a>
  </form>

  <h4>🧺 Item Pesanan</h4>
  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $items = $conn->query("SELECT order_items.*, products.name FROM order_items 
                             JOIN products ON order_items.product_id = products.id 
                             WHERE order_id=$id");
      while ($item = $items->fetch_assoc()) {
        $subtotal = $item['price'] * $item['quantity'];
        echo "<tr>
          <td>{$item['name']}</td>
          <td>{$item['quantity']}</td>
          <td>Rp" . number_format($item['price'], 0, ',', '.') . "</td>
          <td>Rp" . number_format($subtotal, 0, ',', '.') . "</td>
        </tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
