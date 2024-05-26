<?php
include 'config/function.php';
session_start();


if(isset($_POST["kirim"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];

$cek = mysqli_query($conn,"SELECT * FROM user WHERE email = '$email'");
    if( mysqli_num_rows($cek) === 1) {
        $row = mysqli_fetch_assoc($cek);
        if (password_verify($password, $row["password"])) {
            header("Location: index.php");
            $_SESSION["login"] = true; 
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_id"] = $row["user_id"];
        }
        exit;
        
    }
    header("Location:login.php?pesan=gagal");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Website</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="https://img.icons8.com/wired/64/000000/gallery.png" type="image/x-icon">
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand">Galeri Foto</a>
    <div class="d-flex">
      <a href="register.php" class="btn btn-outline-success" >Register</a>
    </div>
  </div>
</nav>
<div class="container-fluid py-5">
  <div class="row justify-content-center " >
    <div class="col-md-4 " >
      <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded " style="height:27rem; width:30rem;">
        <div class="card-body bg-light">
          <div class="text-center">
            <h5>Login Aplikasi</h5>
          </div>
          <form action="" method="post">
            <label for="user" class="from-label">Masukan Email:</label>
            <input type="email" name="email" class="form-control" required>
            <label for="password" class="from-label">Password:</label>
            <input type="password" name="pass" class="form-control" required>
            <div class="d-grid mt-2">
              <button class="btn btn-primary" type="submit" name="kirim">Masuk</button>
            </div>
          </form>
 <hr>
 <p class="text-center">Belum Punya aku?? <a href="register.php">Register Disini!!</a></p>
 <div class="text-center">
 <?php
if(isset($_GET['pesan'])) {
    if($_GET['pesan']=="gagal") {
        echo "Login gagal! Username/Password Salah";
    }else if($_GET['pesan']=="logout") {
        echo "Anda Berhasil Logout";
    } else if($_GET['pesan']=="belum_login") {
        echo "anda harus login";
    } else if($_GET['pesan']=="daftar") {
        echo "anda berhasil menambahkan akun";
    }
}
?>
 </div>
</body>
</html>