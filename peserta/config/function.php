<?php

$host = "localhost";
$root = "root";
$pass = "";
$db = "peserta";

$conn = mysqli_connect($host,$root,$pass,$db);



function bikin($data) {
    global $conn;
    $username = strtolower(stripslashes($data["user"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $email = mysqli_real_escape_string($conn,$data["email"]);
    $namalengkap = mysqli_real_escape_string($conn,$data["namaLengkap"]);
    $alamat = mysqli_real_escape_string($conn,$data["alamat"]);
    

  $result=  mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' OR email = '$email'");
  if(mysqli_fetch_assoc($result)) {
    echo "<script>alert('username atau email yang dpilih sudah terdaftar')</script>";
    return false;
  }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    mysqli_query($conn,"INSERT INTO user VALUES('', '$username','$password','$email','$namalengkap','$alamat')");

    return mysqli_affected_rows($conn);

}





?>