<?php

session_start();

require 'config.php';

if (isset($_GET['id'])) {
   $Pertandingan = $collectionPertandingan->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}

if(isset($_POST['submit'])){
   // Convert 'harga' to integer
   $harga = intval($_POST['harga']);

   // Mengirim hasil update ke MongoDB
   $collectionPertandingan->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' => [
           'pertandingan_id' => $_POST['pertandingan_id'],
           'nama' => $_POST['nama'],
           'lokasi' => $_POST['lokasi'],
           'tanggal' => $_POST['tanggal'],
           'harga' => $harga // Updated 'harga' as an integer
       ]]
   );

   if (isset($_SESSION['success'])) {
      echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
      unset($_SESSION['success']); // Pesan sementara
   }

   header("Location: Pertandingan.php");
}

?>

<!DOCTYPE html>
<html>
<head>
   <title>Database Pertandingan</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
   <h1>Ubah Data Pertandingan</h1>
   <a href="Pertandingan.php" class="btn btn-primary">Kembali</a>
   <form method="POST">
      <div class="form-group">
         <strong>Pertandingan ID:</strong>
         <input type="text" name="pertandingan_id" value="<?php echo $Pertandingan->pertandingan_id; ?>" required="" class="form-control" placeholder="pertandingan_id">
      </div>
      <div class="form-group">
         <strong>Name:</strong>
         <input type="text" name="nama" value="<?php echo $Pertandingan->nama; ?>" required="" class="form-control" placeholder="nama">
      </div>
      <div class="form-group">
         <strong>Lokasi:</strong>
         <textarea class="form-control" name="lokasi" placeholder="lokasi" required=""><?php echo $Pertandingan->lokasi; ?></textarea>
      </div>
      <div class="form-group">
         <strong>Tanggal:</strong>
         <input type="date" name="tanggal" value="<?php echo $Pertandingan->tanggal; ?>" required="">
      </div>
      <div class="form-group">
         <strong>Harga:</strong>
         <input type="text" name="harga" value="<?php echo $Pertandingan->harga; ?>" required="" class="form-control" placeholder="harga">
      </div>
      <button type="submit" name="submit" class="btn btn-success">Kirim</button>
   </form>
</div>
</body>
</html>
