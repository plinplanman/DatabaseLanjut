
<?php
include 'header.php';
?>
<!DOCTYPE html>

<html>

<head>

   <title>Database Pesanan</title>

   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>


<div class="container">

<h1>Pengelolaan Data Pesanan</h1>
<a href="index.php" class="btn btn-success">kembali</a><br>

<a href="createpesanan.php" class="btn btn-success"> Tambah Pesanan</a>



<?php


   if(isset($_SESSION['success'])){

      echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";

   }


?>


<table class="table table-borderd">

   <tr>
    <th>Pesanan ID</th>
      <th>Username Pemesan</th>
      <th>Pertandingan ID</th>
      <th>Jumlah Tiket</th>
      <th>Total Harga</th>
      <th>Action</th>

   </tr>

   <?php


      require 'config.php';


      $pesanans = $collectionPesanan->find([]);


      foreach($pesanans as $pesanan) {
        echo "<tr>";
        echo "<td>".(isset($pesanan->_id) ? $pesanan->_id : "")."</td>";
        

        echo "<td>".(isset($pesanan->username) ? $pesanan->username : "")."</td>";

        echo "<td>".(isset($pesanan->pertandingan_id) ? $pesanan->pertandingan_id : "")."</td>";

        echo "<td>".(isset($pesanan->jumlah_tiket) ? $pesanan->jumlah_tiket : "")."</td>";

        echo "<td>Rp. ".(isset($pesanan->total_harga) ? $pesanan->total_harga : "")."</td>";



        echo "<td>";
        echo "<a href='editpesanan.php?id=".$pesanan->_id."' class='btn btn-primary'>Edit</a>";
        echo "<a href='delete.php?id=".$pesanan->_id."' class='btn btn-danger'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    };
    


   ?>

</table>

</div>


</body>

</html>