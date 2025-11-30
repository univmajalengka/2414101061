<?php
session_start();
include 'includes/config.php';

// 🔍 Ambil filter & pencarian dari URL
$category = $_GET['category'] ?? 'all';
$search = $_GET['search'] ?? '';

// 🔎 Query produk dinamis
$query = "SELECT * FROM products WHERE 1";
if ($category != 'all') {
    $query .= " AND category = '$category'";
}
if (!empty($search)) {
    $query .= " AND name LIKE '%$search%'";
}
$query .= " ORDER BY id DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title> A7 SportStore | Toko Jersey & Sepatu Olahraga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }

        .hero {
            background: url('assets/img/banner-sport.jpg') center/cover no-repeat;
            color: white;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.6);
            padding: 80px 0;
        }
    </style>
</head>

<body>

    <!-- 🔝 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">🏆A7 SportStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="status_pesanan.php">Status Pesanan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="cart.php"><i class="bi bi-cart"></i> Keranjang
                            <?php if (!empty($_SESSION['cart'])) echo '<span class="badge bg-danger">' . count($_SESSION['cart']) . '</span>'; ?>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
                    <li class="nav-item dropdown">
                        <?php if (isset($_SESSION['users'])): ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?= $_SESSION['users']['name']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="buyer/profile.php">Profil Saya</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                <li><a class="dropdown-item" href="admin/login.php">Login Admin</a></li>
                            </ul>
                        <?php else: ?>
                            <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        <?php endif; ?>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- 🏷️ Hero Section -->
    <div class="hero">
        <div class="overlay text-center">
            <h1 class="fw-bold display-5">Selamat Datang di A7 SportStore</h1>
            <p class="lead">Temukan koleksi Jersey & Sepatu olahraga terbaik untuk performa maksimal!</p>
            <a href="#produk" class="btn btn-light btn-lg mt-2">Belanja Sekarang</a>
        </div>
    </div>

    <!-- 🔍 Filter & Search -->
    <div class="container my-5">
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-md-6 mb-2">
                <form class="d-flex" method="GET" action="index.php">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-md-4 mb-2 text-end">
                <div class="btn-group" role="group">
                    <a href="index.php?category=all" class="btn btn-<?= $category == 'all' ? 'primary' : 'outline-primary' ?>">Semua</a>
                    <a href="index.php?category=Jersey" class="btn btn-<?= $category == 'Jersey' ? 'primary' : 'outline-primary' ?>">Jersey</a>
                    <a href="index.php?category=Sepatu" class="btn btn-<?= $category == 'Sepatu' ? 'primary' : 'outline-primary' ?>">Sepatu</a>
                </div>
            </div>
        </div>

        <!-- 🏀 Produk Grid -->
        <div class="row" id="produk">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="uploads/<?= $row['image']; ?>" class="card-img-top" style="height:230px;object-fit:cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= $row['name']; ?></h5>
                                <p class="text-muted mb-1"><?= $row['category']; ?></p>
                                <p class="text-muted mb-1"><?= $row['stok']; ?></p>
                                <p class="text-muted mb-1"><?= $row['ukuran']; ?></p>
                                <p class="fw-bold mb-3">Rp<?= number_format($row['price'], 0, ',', '.'); ?></p>
                                <a href="product.php?id=<?= $row['id']; ?>" class="btn btn-outline-primary w-100 mt-auto">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <h5 class="text-muted">Produk tidak ditemukan 😔</h5>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="container my-5">
        <div class="card mx-auto shadow-lg border-0" style="max-width: 400px; border-radius: 20px;">
            <div class="card-body text-center p-4">
                <img src="uploads/owner.jpg" alt="Owner A7 SportStore"
                    class="rounded-circle mb-3" width="150" height="150"
                    style="object-fit: cover; border: 4px solid #0d6efd;">
                <h4 class="fw-bold mb-0">Angga Js</h4>
                <p class="text-muted mb-3">Owner & Admin A7 SportStore</p>
                <p class="small text-secondary">
                    “Kami berkomitmen menyediakan perlengkapan olahraga berkualitas tinggi untuk semua pelanggan kami.
                    Terima kasih telah berbelanja di A7 SportStore!”
                </p>
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <a href="mailto:anggajanuarsetiadi013@gmail.com" class="btn btn-outline-primary btn-sm">✉ Email</a>
                    <a href="https://wa.me/6281220658786" class="btn btn-success btn-sm">💬 WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 💬 Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; <?= date('Y'); ?> A7 SportStore. Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>