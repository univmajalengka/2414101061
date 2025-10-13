<?php
session_start();
include '../includes/config.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // gunakan password_hash() jika ingin lebih aman

  $result = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
  
  if ($result->num_rows > 0) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    header("Location: index.php");
  } else {
    $error = "Username atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="width: 400px;">
  <h3 class="text-center mb-4">Login Admin</h3>
  <?php if (isset($error)) { ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php } ?>
  <form method="POST">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
  </form>
</div>

</body>
</html>
