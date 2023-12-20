<?php


session_start();


if(isset($_POST['submit'])){


   require 'config.php';


   $insertOneResult = $collectionPengguna->insertOne([

      'username' => $_POST['username'],
 
      'nama' => $_POST['nama'],

       'email' => $_POST['email'],

   ]);


   $_SESSION['success'] = "";

   header("Location: pengguna.php");

}


?>


<!DOCTYPE html>

<html>

<head>

   <title>Pengelolaan </title>

   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>


<div class="container">

   <h1>Tambah Data</h1>

   <a href="pengguna.php" class="btn btn-primary">kembali</a>


   <form method="POST">
      <div class="form-group">

         <strong>Username:</strong>

         <input type="text" name="username" required="" class="form-control" placeholder="Username">

      </div>

      <div class="form-group">

         <strong>Nama:</strong>

         <input type="text" name="nama" required="" class="form-control" placeholder="Nama">

      </div>

      <div class="form-group">

         <strong>email:</strong>

         <textarea class="form-control" name="email" placeholder="email" placeholder="email"></textarea>

      </div>

      <div class="form-group">

         <button type="submit" name="submit" class="btn btn-success">Submit</button>

      </div>

   </form>

</div>


</body>

</html>