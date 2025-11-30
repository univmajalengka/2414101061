<?php
session_start();
include "includes/config.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
    $_SESSION['users'] = [
        'id' => $data['id'],
        'name' => $data['nama'], // gunakan field 'nama' dari database
        'email' => $data['email']
    ];

    header("Location: index.php");
    exit();
}

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
  <div class="card p-4 shadow" style="width:400px;">
    <h3 class="text-center">Login</h3>
    <form method="post">
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
      <p class="text-center mt-3">Belum punya akun? <a href="register.php">Register</a></p>
    </form>
  </div>
</div>
</body>
</html>