<?php

session_start();

include 'function.php';
if(isset($_POST['kirim'])) {
    $nama = $_POST["nama"];
    $deskripsi = $_POST["deskripsi"];
    $tanggal = date('Y-m-d');
    $userId = $_SESSION['user_id'];
    $sql = mysqli_query($conn, "INSERT INTO album VALUES('','$nama','$deskripsi','$tanggal','$userId')");
    
    echo "<script> alert('data berhasil di simpan')
    location.href='../index.php'</script>";


   
}

if(isset($_POST['edit'])) {
    $albumId = $_POST['album_id'];
    $nama = $_POST["nama"];
    $deskripsi = $_POST["deskripsi"];
    $tanggal = date('Y-m-d');
    $userId = $_SESSION['user_id'];
    $sql = mysqli_query($conn, "UPDATE album SET nama_album = '$nama' , deskripsi = '$deskripsi',tanggal='$tanggal' WHERE album_id = '$albumId'");
    
   
}

if(isset($_POST["hapus"])) {
    $albumId = $_POST['album_id'];
    $sql = mysqli_query($conn,"DELETE FROM album WHERE album_id='$albumId'");
    echo "<script> alert('data berhasil di hapus')
    location.href='../index.php'</script>";


}
 
 


