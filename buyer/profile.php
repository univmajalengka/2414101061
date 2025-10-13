<?php
include '../includes/config.php';
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['users'])) {
  header("Location: ../login.php");
  exit();
}

$user = $_SESSION['users'];

// 🧍 Update data pengguna
if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $email = $user['email']; // email tetap
  $conn->query("UPDATE users SET name='$name' WHERE email='$email'");
  
  // Update session biar nama langsung berubah di navbar
  $_SESSION['users']['name'] = $name;
  $success = "Data berhasil diperbarui!";
}

// 🔐 Ubah password
if (isset($_POST['change_password'])) {
  $old = $_POST['old_password'];
  $new = $_POST['new_password'];

  $query = $conn->query("SELECT * FROM users WHERE email='".$user['email']."'");
  $data = $query->fetch_assoc();

  if (password_verify($old, $data['password'])) {
    $hashed = password_hash($new, PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password='$hashed' WHERE email='".$user['email']."'");
    $success = "Password berhasil diubah!";
  } else {
    $error = "Password lama salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Saya - SportStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- 🔝 Navbar sederhana -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php">🏆 SportStore</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="../index.php" class="nav-link">Beranda</a></li>
        <li class="nav-item"><a href="../logout.php" class="nav-link text-danger">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- 🧍 Profil Section -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="text-center mb-4">👤 Profil Saya</h3>

          <?php if(isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
          <?php endif; ?>

          <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label>Nama Lengkap</label>
              <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" disabled>
            </div>
            <button type="submit" name="update" class="btn btn-primary w-100">Simpan Perubahan</button>
          </form>
        </div>
      </div>

      <div class="card shadow mt-4">
        <div class="card-body">
          <h4 class="mb-3">🔐 Ubah Password</h4>
          <form method="POST">
            <div class="mb-3">
              <label>Password Lama</label>
              <input type="password" name="old_password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password Baru</label>
              <input type="password" name="new_password" class="form-control" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-warning w-100">Ubah Password</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
