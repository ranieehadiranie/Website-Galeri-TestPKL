<?php
include 'config/function.php'; 
session_start();
if(!isset($_SESSION["login"])) {
  header("Location:login.php");
  exit;
}
$sql = mysqli_query($conn, "SELECT * FROM album");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto Saya</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="https://img.icons8.com/wired/64/000000/gallery.png" type="image/x-icon">
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand">Galeri Foto</a>
    <div class="d-flex">
      <a href="index.php" class="btn btn-outline-success" >Kembali</a>
    </div>
  </div>
</nav>
<div id="container">
<table class="table table-bordered" style="width: 70%; margin:auto;">
  <thead class="table">
    <th>No</th>
    <th>Nama Album</th>
    <th>Deskripsi</th>
    <th>Tanggal</th>
    <th>Edit Data</th>
    <th>Hapus Data</th>
  </thead>
  
 <?php 
    $no=1;
    $_SESSION["user_id"];
 while($row=mysqli_fetch_assoc($sql)) { ?>
    <tr class="table-active">
     <td><?= $no ?></td>
     <td> <?= $row["nama_album"];?></td>
     <td><?= $row["deskripsi"] ?></td>
     <td><?= $row["tanggal"]; ?></td>
     <td>
     <button type="button" class="btn btn-primary mx-2 " data-bs-toggle="modal"   data-bs-target="#edit<?php echo $row['album_id'] ;?>">
        Edit Data
            </button>
           
            <div class="modal fade" id="edit<?php echo $row['album_id'] ;?>"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="edit">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./config/aksi_album.php" method="post">
                <input type="hidden" name="album_id" value="<?= $row['album_id'] ;?>">
                <label for="nama" class="from-label" style="margin-top: 15px;">Nama Album:</label>
                <input type="text" name="nama" value="<?= $row["nama_album"];?>" class="form-control" required>
                <div style="display: flex; flex-direction:column; margin-top:25px">
                <label for="tambahkan Deskripsi" class="from-label" >Deskripsi:</label>
                 <textarea name="deskripsi" value="asasa" id="deskripsi" style="width: 100%; height:90px; font-size:12px; padding:5px;" ></textarea>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
            </form>
      </div>
    </div>
  </div>
</div>
     </td>
     <td>
        <!-- hapys -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal"   data-bs-target="#hapus<?php echo $row['album_id'] ;?>">
        Hapus
            </button>
            <div class="modal fade" id="hapus<?php echo $row['album_id'] ;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="Hapus">Hapus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./config/aksi_album.php" method="post">
                <input type="hidden" name="album_id" value="<?= $row['album_id'] ;?>">
                <p>apakah anda yakin akan menghapus data dari <?= $row['nama_album'];?></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="hapus" class="btn btn-primary">Hapus Data</button>
            </form>
      </div>
    </div>
  </div>
</div>
     </td>
    
</tr>
<?php $no++; }?>
</table>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

