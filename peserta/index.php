<?php
include 'config/function.php'; 
session_start();
$userId = $_SESSION['user_id'];
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
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="https://img.icons8.com/wired/64/000000/gallery.png" type="image/x-icon">
</head>
<body class="bg-slate-600">
<header x-data="{mobileOpen : false}" class="md:flex items-center justify-between [&>*]:px-8 bg-gray-800 h-20 text-white sticky top-0 z-50">
      <div class="flex items-center justify-between h-20">
        <logo>
          <a class="flex items-center gap-1">
            <img class="h-8 -mt-1 " src="https://img.icons8.com/wired/64/ffffff/gallery.png" alt="fire-element--v1" />
            <span>Galeri </span>
          </a>
        </logo>
        <mobileicon class="md:hidden">
          <a @click="mobileOpen = !mobileOpen " class="h-12 w-12 flex items-center justify-center cursor-pointer hover:bg-gray-700 rounded-lg">
            <img x-show="!mobileOpen" class="h-6 w-6 select-none" src="https://img.icons8.com/small/64/ffffff/menu.png" alt="" />
            <img x-show="mobileOpen" x-cloak class="h-6 w-6 select-none" src="https://img.icons8.com/small/64/ffffff/delete-sign.png" alt="" />
          </a>
        </mobileicon>
      </div>
      <nav
        x-show="mobileOpen"
        x-cloak
        class="md:!block bg-gray-800 h-screen w-screen md:h-auto md:w-auto -mt-20 md:mt-0 absolute md:relative z-[-1]"
        x-transition:enter="duration-300 ease-out"
        x-transition:enter-start="opacity-0 -translate-y-96"
        x-transition:enter-end="opacity-100 translate-y-0"
      >
        <ul class="flex items-center [&>li>a]:h-12 [&>li>a]:px-4 [&>li>a:hover]:bg-gray-700 [&>li>a]:rounded-lg [&>li>a]:flex [&>li>a]:items-center [&>li>a]:gap-2 flex-col md:flex-row gap-8 md:gap-0 justify-center h-full -translate-y-10 md:translate-y-0">
          <li><a href="#">Home</a></li>
          <li><a href="upload.php">Tambahkan Album</a></li>
          <li><a href="foto.php">Upload foto</a></li>
          <li class="relative" x-data="{dropdown: false}">
            <a @click="dropdown = !dropdown" @click.away="dropdown = false" class="cursor-pointer select-none">
              <img class="h-8 rounded-full object-cover bg-teal-200" src="https://img.icons8.com/ios/50/gender-neutral-user--v1.png" alt="the-flash-head" />
              <?= $_SESSION['username'] ;?>
              <img x-bind:class="dropdown ? 'rotate-180 duration-300' : 'duration-300'" class="w-4" src="https://img.icons8.com/material-outlined/48/777777/expand-arrow--v1.png" alt="expand-arrow--v1" />
            </a>
            <div
              class="absolute right-0 bg-white text-black shado rounded-lg w-40 p-2 z-20"
              x-show="dropdown"
              x-cloak
              x-transition:enter="duration-300 ease-out"
              x-transition:enter-start="opacity-0 -translate-y-5 scale-90"
              x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            >
              <ul class=" [&>*:hover]:bg-gray-200 [&>*]:rounded-md [&>*]:transition [&>*]:duration-150; [&>li>a]:justify-end [&>*>a]:p-2 [&>*>a]:flex [&>*>a]:items-center">
                <li><a href="fotosaya.php">Album Saya</a></li>
                <li><a href="fotosayaimg.php">Foto Saya</a></li>
                <li><a href="logout.php">Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <!--  -->
    <!--  -->
    <!--  -->
    <!--  -->
    <content x-data="{mobileSide : false}" class="grid grid-cols-3 max-w-7xl mx-auto mt-6">
    <!-- mulai -->
    <?php
        $query = mysqli_query($conn,"SELECT * FROM foto ");
        while($data = mysqli_fetch_array($query))  {
    ?>
      <main class="col-span-full mx-[5%] md:col-span-2 md:mx-[10%] order-2 md:order-1 mt-10">
        <article class="card shadow-lg rounded-lg bg-sky-100">
          <div class="flex items-center justify-between px-4 h-14">

            <h3 class="text-lg font-bold w-[50%] truncate flex m-4">
            <img class="h-8 rounded-full object-cover bg-teal-200 mr-3" src="https://img.icons8.com/ios/50/gender-neutral-user--v1.png" alt="the-flash-head" />
              <?= $data['nama_pengirim'];?>
            </h3>
            <div class="text-sm text-gray-500"><?= $data['tanggal_unggah'];?></div>
          </div>
          <figure>
            <img src="./assets/img/<?= $data['lokasi'];?>" class="w-full" />
          </figure>
          <div class="p-4 pb-2">
            <a class="flex items-center gap-1 mb-4" href="">
              <img class="w-8 h-8 rounded-full" src="https://img.icons8.com/small/96/A9A9A9/happy.png" alt="" />
              <span class="font-bold hover:underline"><?= $data['nama_pengirim'];?></span>
            </a>
            <p class="text-3xl font-bold uppercase mb-3 px-4"><?= $data['judul_foto'];?></p>
            <div class="flex ml-5 gap-0 mb-5 container flex-col">
             <div>
              <p class="font-bold text-lg ">Deskripsi:</p>
             </div>
             <p class="font-md "><?= $data['deskripsi_foto'];?></p>
            </div>
            <div class="mt-4 p-3 text-center rounded-lg bg-sky-700 w-20 ml-5 cursor-pointer hover:bg-sky-900 mb-4">
               <a href="detail.php?foto_id=<?= $data['foto_id'] ;?>" class="text-white font-semibold">Detail</a>
            </div>
            <div class="flex items-center justify-between text-sm px-2">
         
              <div class="flex items-center gap-4 [&>a:hover]:underline"> 
                <?php
                $foto_id = $data["foto_id"];
                $cekSuka = mysqli_query($conn, "SELECT * FROM likefoto WHERE foto_id = '$foto_id' AND user_id = '$userId'"); 

                if(mysqli_num_rows($cekSuka) == 1) { ?>
                  <a href="./config/proses_like.php?foto_id=<?= $data['foto_id'] ;?>" type="submit" name="batalsuka"><i class="fa fa-heart" style="width: 20px; font-size:30px;margin:10px;"></i></a>
                <?php  } else { ?>
                  <a href="./config/proses_like.php?foto_id=<?= $data['foto_id'] ;?>" type="submit" name="suka"><i class="fa-regular fa-heart" style="width: 20px; font-size:30px;margin:10px;"></i></a>
                <?php } ?>
              <?php 

                $like = mysqli_query($conn,"SELECT * FROM likefoto WHERE foto_id = '$foto_id'");
                echo mysqli_num_rows($like) . ' Suka'
                ?>
              </div>
            </div>
          </div>
        </article>
      </main>
      <?php } ; ?>
      
    <!-- akhier -->
    </content>
</body>
</html>