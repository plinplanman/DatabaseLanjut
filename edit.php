<?php


session_start();


require 'config.php';


if (isset($_GET['id'])) {

   $pengguna = $collectionPengguna->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

}


if(isset($_POST['submit'])){

//mengirim hasil update ke mongodb
   $collectionPengguna->updateOne(

       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],

       ['$set' => ['username'=> $_POST ['username'],'nama' => $_POST['nama'], 'email' => $_POST['email'],]]

   );


   if (isset($_SESSION['success'])) {
      echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
      unset($_SESSION['success']); //pesan sementara
  }

   header("Location: pengguna.php");

}


?>


<!DOCTYPE html>

<html>

<head>

   <title>Database pengguna</title>

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


<div class="container">

   <h1>Ubah Data Pengguna</h1>

   <a href="pengguna.php" class="btn btn-primary">kembali</a>


   <form method="POST">

      <div class="form-group">

         <strong>Username:</strong>
         
         <input type="text" name="username" value="<?php echo $pengguna->username; ?>" required="" class="form-control" placeholder="username">
      </div>

      

      <div class="form-group">

         <strong>Name:</strong>

         <input type="text" name="nama" value="<?php echo $pengguna->nama; ?>" required="" class="form-control" placeholder="nama">

      </div>

      <div class="form-group">

         <strong>Email:</strong>

         <textarea class="form-control" name="email" placeholder="email" placeholder="email"><?php echo $pengguna->email; ?></textarea>

      </div>

      <div class="form-group">

         <button type="submit" name="submit" class="btn btn-success">Kirim</button>

      </div>

   </form>

</div>


</body>

</html>