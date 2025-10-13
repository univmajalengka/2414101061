<?php
session_start();
include 'includes/config.php';
// kalau belum login, langsung arahkan ke halaman login
if (!isset($_SESSION['users'])) {
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
  <div class="row">
    <div class="col-md-6">
      <img src="uploads/<?php echo $product['image']; ?>" alt="product" width="300" height="300" style="object-fit: cover; border-radius: 10px;">
    </div>
    <div class="col-md-6">
      <h3><?php echo $product['name']; ?></h3>
      <p class="text-muted">Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
      <p><?php echo $product['ukuran']; ?></p>
      <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <button type="submit" name="add_to_cart" class="btn btn-success w-100">Tambah ke Keranjang</button>
      </form>
    </div>
  </div>
</div>

