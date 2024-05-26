<?php 

session_start();
include 'function.php';
$fotoId =$_GET['foto_id'];
$userId = $_SESSION['user_id'];


$cekSuka = mysqli_query($conn, "SELECT * FROM likefoto WHERE foto_id = '$fotoId' AND user_id = '$userId'"); 

if(mysqli_num_rows($cekSuka) == 1) {
    while($row = mysqli_fetch_array($cekSuka)) {
        $likeId = $row['like_id'];
        $query =mysqli_query($conn, "DELETE FROM likefoto WHERE like_id = '$likeId'");
        echo "<script>
        location.href='../index.php'
        </script>";
    }
}
     else  {
        $tanggal_like = date('Y-m-d');
        $query = mysqli_query($conn, "INSERT INTO likefoto VALUES('','$fotoId','$userId','$tanggal_like')");
        echo "<script>
        location.href='../index.php'
        </script>";
     }
    

