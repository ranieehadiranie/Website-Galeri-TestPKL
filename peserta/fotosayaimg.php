<?php
include 'config/function.php'; 
session_start();
if(!isset($_SESSION["login"])) {
  header("Location:login.php");
  exit;
}

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
<table class="table table-bordered">
  <thead class="table">
    <th>No</th>
    <th>Nama Foto</th>
    <th>Judul Foto</th>
    <th>Deskripsi</th>
    <th>Tanggal</th>
    <th>Jumlah Like</th>
    <th>Edit Data</th>
    <th>Hapus Data</th>
  </thead>
  
 <?php 
    $no=1;
  $user_id =   $_SESSION["user_id"];
    $sql = mysqli_query($conn, "SELECT * FROM foto WHERE user_id = $user_id");
 while($row=mysqli_fetch_assoc($sql)) { ?>
    <tr class="table-active">
     <td><?= $no ;?></td>
     <td><img src="./assets/img/<?= $row['lokasi'];?>" width="300px" height="200px" alt=""></td>
     <td> <?= $row["judul_foto"];?></td>
     <td><?= $row["deskripsi_foto"] ?></td>
     <td><?= $row["tanggal_unggah"]; ?></td>
     <td>
    <?php  $sql2 = mysqli_query($conn,"SELECT * FROM likefoto"); 
    $data = mysqli_num_rows($sql2);
        echo $data;
    ?>
     </td>
     <td>
     <button type="button" class="btn btn-primary mx-2 " data-bs-toggle="modal"   data-bs-target="#edit<?php echo $row['foto_id'] ;?>">
        Edit Data
            </button>
           
            <div class="modal fade" id="edit<?php echo $row['foto_id'] ;?>"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="edit">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./config/aksi_foto.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="foto_id" value="<?= $row['foto_id'] ;?>">
                <label for="nama" class="from-label" style="margin-top: 15px;">Judul Foto:</label>
                <input type="text" name="judulfoto" value="<?= $row["judul_foto"];?>" class="form-control"  >
                <div style="display: flex; flex-direction:column; margin-top:25px">
                <label for="tambahkan Deskripsi" class="from-label" >Deskripsi:</label>
                 <textarea name="deskripsi" value="asasa" id="deskripsi" style="width: 100%; height:90px; font-size:12px; padding:5px;" > <?= $row['deskripsi_foto'];?></textarea>
                
                 <label for="nama" class="from-label">Album</label>
            <select name="albumid" class="form-control">
            <?php $sql_album = mysqli_query($conn, "SELECT * FROM album WHERE user_id = $user_id");
                    while($data_album = mysqli_fetch_array($sql_album)) { ?>
                    <option <?php if( $data_album['album_id'] == $row['album_id']) { ?> 
                            selected = "selected";
                        <?php } ;?> value="<?= $data_album['album_id'];?>"><?= $data_album['nama_album'];?></option>
                 <?php };  ?>
            </select>
            <label class="from-label" style="margin-top: 15px;"> Foto:</label>
                <div class="row">
                    <div class="col-md-4">
                    <img src="./assets/img/<?= $row['lokasi'];?>" width="150px" height="100px" alt="">
                    </div>
                    <div class="col-md-8">
                    <label for="nama" class="from-label" style="margin-top: 15px;">Ganti File</label>
                    <input type="file" class="form-control" name="lokasifile">
                    </div>
                </div>
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
<button type="button" class="btn btn-danger" data-bs-toggle="modal"   data-bs-target="#hapus<?php echo $row['foto_id'] ;?>">
        Hapus
            </button>
            <div class="modal fade" id="hapus<?php echo $row['foto_id'] ;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="Hapus">Hapus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="./config/aksi_foto.php" method="post">
                <input type="hidden" name="foto_id" value="<?= $row['foto_id'] ;?>">
                <p>apakah anda yakin akan menghapus data dari <?= $row['judul_foto'];?></p>
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

