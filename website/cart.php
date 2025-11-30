<?php
session_start();
include 'includes/config.php';

// Pastikan user sudah login
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit();
}

// Inisialisasi keranjang
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hapus item dari keranjang
if (isset($_GET['hapus'])) {
    $hapus = $_GET['hapus'];
    unset($_SESSION['cart'][$hapus]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // reset index array
    header("Location: cart.php");
    exit();
}

// Tambah produk ke keranjang
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $result = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $produk = $result->fetch_assoc();

    if ($produk) {
        // Data produk dalam array
        $item = [
            'id'     => $produk['id'],
            'nama'   => $produk['name'],
            'harga'  => $produk['price'],
            'qty'    => 1,
            'ukuran' => $produk['ukuran'],
            'gambar' => $produk['image']
        ];

        // Cek apakah produk sudah ada di keranjang
        $found = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $item['id']) {
                $cart_item['qty']++;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = $item;
        }
    }

    header("Location: cart.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];

// Pastikan semua item valid (array)
foreach ($cart as $key => $item) {
    if (!is_array($item)) {
        unset($cart[$key]);
    }
}
$_SESSION['cart'] = $cart;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <h2 class="mb-4">🛒 Keranjang Belanja</h2>

    <?php if (empty($cart)) : ?>
        <div class="alert alert-info">Keranjang kamu kosong.</div>
        <a href="index.php" class="btn btn-primary">Kembali ke Belanja</a>
    <?php else : ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                foreach ($cart as $index => $item): 
                    $total = $item['harga'] * $item['qty'];
                    $grand_total += $total;
                ?>
                <tr>
                    <td>
                        <img src="uploads/<?= htmlspecialchars($item['gambar']) ?>" width="60" height="60" style="object-fit:cover; border-radius:8px;">
                        <br><?= htmlspecialchars($item['nama']) ?><br>
                        <small>Ukuran: <?= htmlspecialchars($item['ukuran']) ?></small>
                    </td>
                    <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>Rp<?= number_format($total, 0, ',', '.') ?></td>
                    <td>
                        <a href="cart.php?hapus=<?= $index ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr class="table-secondary">
                    <td colspan="3" class="text-end"><strong>Total Keseluruhan</strong></td>
                    <td colspan="2"><strong>Rp<?= number_format($grand_total, 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary">← Lanjut Belanja</a>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>