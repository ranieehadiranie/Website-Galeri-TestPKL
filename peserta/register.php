<?php

include 'config/function.php';

if(isset($_POST["kirim"])) {


    if(bikin($_POST) > 0 ){
        echo "<script> alert('user baru berhasil di tambahkan')</script>";
       header("Location:login.php?pesan=daftar");
    } else {
       echo mysqli_error($conn);
    }

  
}  


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="https://img.icons8.com/wired/64/000000/gallery.png" type="image/x-icon">
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand">Galeri Foto</a> 
    <div>
      <a href="login.php" class="btn btn-outline-primary">Login</a>
      </div>
  </div>
</nav>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="height:33rem; width:27rem;">
        <div class="card-body bg-light">
          <div class="text-center">
            <h5>Register Aplikasi</h5>
          </div>
          <form action="" method="post">
            <label for="user" class="from-label">Username:</label>
            <input type="text" name="user" class="form-control" required>
            <label for="password" class="from-label">Password:</label>
            <input type="password" name="password" class="form-control" required>
            <label for="" class="from-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
            <label for="" class="from-label">Nama Lengkap:</label>
            <input type="text" name="namaLengkap" class="form-control" required>
            <label for="" class="from-label">Alamat:</label>
            <input type="text" name="alamat" class="form-control" required>
            <div class="d-grid mt-2">
              <button class="btn btn-primary" type="submit" name="kirim">Masuk</button>
            </div>
          </form>
          <hr>
          <p class="text-center">Sudah Punya Akun? <a href="login.php">Login  Disini!!</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
    <script text="text/javascript" src="asset/css/bootstrap.min.js"></script>
</body>
</html>