<?php
session_start();
if(!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
  }
  
include 'function.php';
if(isset($_POST['kirim'])) {
    $judul_foto = $_POST["judul"];
    $deskripsi_foto= $_POST["deskripsi"];
    $tanggal_unggah = date('Y-m-d');
    $userId = $_SESSION['user_id'];
    $albumId = $_POST['albumid'];
    $nama_pengirim = $_SESSION['username'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $nama_foto = rand(). '-' . $foto;
    move_uploaded_file($tmp, $lokasi.$nama_foto);

    $sql = mysqli_query($conn, "INSERT INTO foto VALUES('','$judul_foto','$deskripsi_foto','$tanggal_unggah','$nama_pengirim','$nama_foto','$albumId','$userId')");
    
    echo "<script> alert('data berhasil di simpan')
    location.href='../index.php'</script>";

}


if(isset($_POST['edit'])) {
    $foto_id = $_POST['foto_id'];
    $judul_foto = $_POST["judul"];
    $deskripsi_foto= $_POST["deskripsi"];
    $tanggal_unggah = date('Y-m-d');
    $userId = $_SESSION['user_id'];
    $albumId = $_POST['albumid'];
    $nama_pengirim = $_POST['namaPengirim'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $nama_foto = rand(). '-' . $foto;

    if($foto === null) {
        $sql = mysqli_query($conn, "UPDATE foto SET judul_foto= '$judul_foto',deskripsi_foto='$deskripsi_foto',tanggal_unggah='$tanggal_unggah',nama_pengirim='$nama_pengirim',album_id='$albumId' WHERE foto_id= '$foto_id'");
    } else {
        $query = mysqli_query($conn, "SELECT * FROM foto WHERE foto_id = '$foto_id'");
        $data = mysqli_fetch_array($query);
        if(is_file('../assets/img/' . $data['lokasi'])) {
            unlink('../assets/img/' . $data['lokasi']);
        }
        move_uploaded_file($tmp, $lokasi.$nama_foto);
        $sql = mysqli_query($conn, "UPDATE foto SET judul_foto= '$judu_foto',deskripsi_foto='$deskripsi_foto',tanggal_unggah='$tanggal_unggah',nama_pengirim='$nama_pengirim','lokasi = '$nama_foto',album_id='$albumId' WHERE foto_id= '$foto_id'");
    }
    echo "<script> alert('data berhasil di simpan')
    location.href='../fotosayaimg.php'</script>";

} 


if(isset($_POST['hapus'])) {
    $foto_id = $_POST['foto_id'];
    $query = mysqli_query($conn, "SELECT * FROM foto WHERE foto_id = '$foto_id'");
         $data = mysqli_fetch_array($query);
    if(is_file('../assets/img/' . $data['lokasi'])) {
        unlink('../assets/img/' . $data['lokasi']);
    }   
    $sql =mysqli_query($conn, "DELETE FROM foto WHERE foto_id = '$foto_id'");
    echo "<script> alert('data berhasil di simpan')
    location.href='../fotosayaimg.php'</script>";

}
 
