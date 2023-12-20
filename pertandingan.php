
<?php
include 'header.php';
?>
<!DOCTYPE html>

<html>

<head>

   <title>Database Pertandingan</title>

   <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>


<div class="container">

<h1>Pengelolaan Data Pertandingan</h1>
<a href="index.php" class="btn btn-success">kembali</a><br>

<a href="createpertandingan.php" class="btn btn-success"> Tambah Pertandingan</a>



<?php


   if(isset($_SESSION['success'])){

      echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";

   }


?>


<table class="table table-borderd">

   <tr>
      <th>Pertandingan ID</th>
      <th>Nama</th>
      <th>Lokasi</th>
      <th>Tanggal</th>
      <th>Harga </th>
      <th>Action</th>

   </tr>

   <?php


      require 'config.php';


      $Pertandingans = $collectionPertandingan->find([]);


      foreach($Pertandingans as $Pertandingan) {
        echo "<tr>";
        echo "<td>".(isset($Pertandingan->pertandingan_id) ? $Pertandingan->pertandingan_id : "")."</td>";

        echo "<td>".(isset($Pertandingan->nama) ? $Pertandingan->nama : "")."</td>";

        echo "<td>".(isset($Pertandingan->lokasi) ? $Pertandingan->lokasi : "")."</td>";

        echo "<td>".(isset($Pertandingan->tanggal) ? $Pertandingan->tanggal : "")."</td>";

        echo "<td>Rp.".(isset($Pertandingan->harga) ? $Pertandingan->harga : "")."</td>";


        echo "<td>";
        echo "<a href='editpertandingan.php?id=".$Pertandingan->_id."' class='btn btn-primary'>Edit</a>";
        echo "<a href='delete.php?id=".$Pertandingan->_id."' class='btn btn-danger'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    };
    


   ?>

</table>

</div>


</body>

</html>