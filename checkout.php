<?php
session_start();
include 'includes/config.php';

// Kalau belum login, arahkan ke login
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "<script>alert('Keranjang masih kosong!'); window.location='index.php';</script>";
    exit();
}

if (isset($_POST['checkout'])) {
    $name    = $_POST['name'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $user_id = $_SESSION['users']['id'];
    $total   = 0;

    foreach ($cart as $item) {
        $total += $item['harga'] * $item['qty'];
    }

    // Simpan ke tabel orders
    $queryOrder = "INSERT INTO orders (user_id, name, address, phone, total, status, created_at)
                   VALUES ('$user_id', '$name', '$address', '$phone', '$total', 'Menunggu Konfirmasi', NOW())";
    mysqli_query($conn, $queryOrder);

    // Ambil ID order yang baru dibuat
    $order_id = mysqli_insert_id($conn);

    // Simpan ke tabel order_items
    foreach ($cart as $item) {
        $product_id = $item['id'];
        $quantity   = $item['qty'];
        $price      = $item['harga'];

        $queryItem = "INSERT INTO order_items (order_id, product_id, quantity, price)
                      VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        mysqli_query($conn, $queryItem);
    }

    // Kosongkan keranjang
    unset($_SESSION['cart']);

    echo "<script>alert('Pesanan berhasil dibuat!'); window.location='status_pesanan.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2>🧾 Checkout</h2>
  <form method="POST" action="">
    <div class="mb-3">
      <label>Nama Lengkap</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Alamat Pengiriman</label>
      <textarea name="address" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
      <label>No. Telepon</label>
      <input type="text" name="phone" class="form-control" required>
    </div>

    <h5>Ringkasan Pesanan:</h5>
    <ul class="list-group mb-3">
      <?php 
      $total = 0;
      foreach ($cart as $item): 
          $subtotal = $item['harga'] * $item['qty'];
          $total += $subtotal;
      ?>
      <li class="list-group-item d-flex justify-content-between">
        <?= htmlspecialchars($item['nama']) ?> (<?= $item['qty'] ?>x)
        <span>Rp<?= number_format($subtotal, 0, ',', '.') ?></span>
      </li>
      <?php endforeach; ?>
      <li class="list-group-item d-flex justify-content-between bg-light">
        <strong>Total</strong>
        <strong>Rp<?= number_format($total, 0, ',', '.') ?></strong>
      </li>
    </ul>

    <button type="submit" name="checkout" class="btn btn-success w-100">Proses Pesanan</button>
  </form>
</div>
</body>
</html>