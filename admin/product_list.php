<?php
include '../includes/config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Daftar Produk</h3>
                <a href="tambah_produk.php" class="btn btn-success">+ Tambah Produk</a>
            </div>

            <table class="table table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok per Ukuran</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = $conn->query("
                        SELECT p.*, c.name AS category_name
                        FROM products p
                        LEFT JOIN categories c ON p.category_id = c.id
                        ORDER BY p.id DESC
                    ");

                    if ($query->num_rows > 0) {
                        while ($row = $query->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='text-center'>{$no}</td>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td>{$row['category_name']}</td>";
                            echo "<td>Rp" . number_format($row['price'], 0, ',', '.') . "</td>";

                            // Ambil stok dari tabel product_variants
                            $variants = $conn->query("SELECT ukuran, stok FROM product_variants WHERE product_id = {$row['id']}");
                            echo "<td>";
                            if ($variants->num_rows > 0) {
                                echo "<ul class='mb-0'>";
                                while ($v = $variants->fetch_assoc()) {
                                    echo "<li>{$v['ukuran']} : {$v['stok']}</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<em>Tidak ada data stok</em>";
                            }
                            echo "</td>";

                            echo "<td class='text-center'>
                                    <a href='edit_product.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_product.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus produk ini?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Belum ada produk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>