<?php
include 'includes/config.php';
session_start();

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $check = $conn->query("SELECT * FROM users WHERE email='$email'");
  if ($check->num_rows > 0) {
    $error = "Email sudah terdaftar!";
  } else {
    $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    $_SESSION['user'] = $email;
    header("Location: index.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun - SportStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="text-center mb-4">📝 Daftar Akun Baru</h3>
          <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
          <form method="POST">
            <div class="mb-3">
              <label>Nama Lengkap</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
          </form>
          <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
