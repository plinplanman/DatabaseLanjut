<?php
session_start();

if(isset($_POST['submit'])){

   require 'config.php';

   // Convert 'harga' to decimal
   $harga = floatval($_POST['harga']);

   $insertOneResult = $collectionPertandingan->insertOne([
      'pertandingan_id' => $_POST['pertandingan_id'],
      'nama' => $_POST['nama'],
      'lokasi' => $_POST['lokasi'],
      'tanggal' => $_POST['tanggal'],
      'harga' => $harga, // Use the converted decimal value
   ]);

   header("Location: Pertandingan.php");
}

?>

<!DOCTYPE html>
<html>
<head>
   <title>Pengelolaan pertandingan</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<div class="container">
   <h1>Tambah Data</h1>
   <a href="Pertandingan.php" class="btn btn-primary">kembali</a>
   <form method="POST">
      <div class="form-group">
         <strong>Pertandingan ID :</strong>
         <input type="text" name="pertandingan_id" required="" class="form-control" placeholder="pertandingan_id">
      </div>
      <div class="form-group">
         <strong>Nama:</strong>
         <input type="text" name="nama" required="" class="form-control" placeholder="Nama">
      </div>
      <div class="form-group">
         <strong>Lokasi:</strong>
         <textarea class="form-control" name="lokasi" placeholder="lokasi"></textarea>
      </div>
      <div class="form-group">
         <strong>Tanggal:</strong>
         <input type="date" name="tanggal" required="" class="form-control" placeholder="tanggal">
      </div>
      <div class="form-group">
         <strong>Harga:</strong>
         <input type="number" step="0.01" name="harga" required="" class="form-control" placeholder="harga">
      </div>
      <div class="form-group">
         <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </div>
   </form>
</div>
</body>
</html>
