<?php
include 'auth_check.php';
include '../includes/config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $ukuran = $_POST['ukuran'];
    $stok = $_POST['stok'];

    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $conn->query("UPDATE products SET name='$name', category='$category', price='$price', ukuran='$ukuran', stok='$stok', image='$image' WHERE id=$id");
    } else {
        $conn->query("UPDATE products SET name='$name', category='$category', price='$price', ukuran='$ukuran', stok='$stok' WHERE id='$id'");    }
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">
        <h2 class="mb-4">Edit Produk</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="category" class="form-select">
                    <option value="Jersey" <?= $product['category'] == 'Jersey' ? 'selected' : '' ?>>Jersey</option>
                    <option value="Sepatu" <?= $product['category'] == 'Sepatu' ? 'selected' : '' ?>>Sepatu</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input type="text" name="ukuran" class="form-control" value="<?= $product['ukuran'] ?>" required id="ukuran" placeholder="Contoh: S, M, L, XL">
            </div>
            <div class="mb-3">
                <label for="ukuran" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= $product['stok'] ?>" required id="stok" placeholder="">
            </div>
            <div class="mb-3">
                <label>Gambar Produk</label><br>
                <img src="../uploads/<?= $product['image'] ?>" width="100" class="mb-2"><br>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

</body>

</html>