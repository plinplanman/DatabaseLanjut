<?php
include 'header.php';
?>

<!DOCTYPE html>

<html>

<head>

   <title>Database pengguna</title>

   <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>


<div class="container">

<h1>Pengelolaan Data Pengguna</h1>
<a href="index.php" class="btn btn-success">kembali</a><br>

<a href="create.php" class="btn btn-success"> Tambah Pengguna</a>



<?php


   if(isset($_SESSION['success'])){

      echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";

   }


?>


<table class="table table-borderd">

   <tr>
      <th>username</th>
      <th>nama</th>
      <th>email</th>
      <th>Action</th>
   </tr>

   <?php


      require 'config.php';


      $penggunas = $collectionPengguna->find([]);


      foreach($penggunas as $pengguna) {
        echo "<tr>";

        echo "<td>".(isset($pengguna->username) ? $pengguna->username : "")."</td>";

        echo "<td>".(isset($pengguna->nama) ? $pengguna->nama : "")."</td>";

        echo "<td>".(isset($pengguna->email) ? $pengguna->email : "")."</td>";

        echo "<td>";
        echo "<a href='edit.php?id=".$pengguna->_id."' class='btn btn-primary'>Edit</a>";
        echo "<a href='delete.php?id=".$pengguna->_id."' class='btn btn-danger'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    };
    


   ?>

</table>

</div>


</body>

</html>