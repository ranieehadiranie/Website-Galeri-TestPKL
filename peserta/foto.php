<?php
include 'config/function.php'; 
session_start();
if(!isset($_SESSION["login"])) {
  header("Location:login.php");
  exit;
}
$userId = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Foto</title>
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
<div class="container-fluid py-5">
  <div class="row justify-content-center " >
    <div class="col-md-4 " >
      <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded ">
        <div class="card-body bg-light">
          <div class="text-center">
            <h5 style="font-size: 30px; font-weight:bold;">Tambah Foto</h5>
          </div>
          <form action="./config/aksi_foto.php" method="post" enctype="multipart/form-data">
            <label for="nama" class="from-label" style="margin-top: 15px;">File Foto</label>
            <input type="file" class="form-control" name="lokasifile" required>
            <label for="nama" class="from-label">Judul Foto</label>
            <input type="text" name="judul" class="form-control" required>
            <label for="nama" class="from-label">Nama Pengirim:</label>
            <input type="text" name="namaPengirim" disabled value="<?= $_SESSION['username'];?>" class="form-control" >
            <div style="display: flex; flex-direction:column; margin-top:25px">
            <label for="tambahkan Deskripsi" class="from-label" >Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsifoto" style="width: 100%; height:100px; font-size:12px; padding:5px;" ></textarea></div>
            <label for="nama" class="from-label">Album</label>
            <select name="albumid" class="form-control">
                <?php
                    $sql_album = mysqli_query($conn, "SELECT * FROM album");
                    while($data_album = mysqli_fetch_array($sql_album)) { ?>
                    <option value="<?= $data_album['album_id'];?>"><?= $data_album['nama_album'];?></option>
                 <?php };  ?>
            </select>
            <div class="d-grid mt-2">
              <button class="btn btn-primary" type="submit" name="kirim">Kirim Postingan</button>
            </div>
          
            
          
            
          </form>
</body>
</html>