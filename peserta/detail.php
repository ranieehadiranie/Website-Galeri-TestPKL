<?php
include 'config/function.php'; 
session_start();
if(!isset($_SESSION["login"])) {
  header("Location:login.php");
  exit;
}
$userId = $_SESSION['user_id'];
$id_foto = $_GET['foto_id'];
$sql = mysqli_query($conn,"SELECT * FROM foto WHERE foto_id = '$id_foto'")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="https://img.icons8.com/wired/64/000000/gallery.png" type="image/x-icon">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Tambahkan Postingan</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div class="d-flex">
        <a href="index.php" class="btn btn-danger">Kembali</a>
        </div>
    </div>
  </div>
</nav>
<div style="height:100vh; border:1px solid black; display: flex; align-items: center; justify-content: center;">
<?php 
        while($row=mysqli_fetch_assoc($sql)) { ?>
<div class="card m-4" style="width: 25rem;  ">
  <img src="./assets/img/<?= $row['lokasi'];?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $row['judul_foto'];?></h5>
    <p class="card-text"><b>Deskripsi:</b> <?= $row['deskripsi_foto'];?></p>
    <p class="card-text"><b>Jumlah Like: </b>
    <?php $query = mysqli_query($conn, "SELECT * FROM likefoto");
        echo mysqli_num_rows($query);
    ?>

    </p>
    <p class="card-text"><b>Disposting oleh:</b> <?= $row['nama_pengirim'];?></p>
  
  </div>
  </div>
  <?php } ?>
</div>
</body>
</html>