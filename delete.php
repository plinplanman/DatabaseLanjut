<?php


session_start();

require 'config.php';


$collectionPengguna->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);


$_SESSION['success'] = "";

header("Location: pengguna.php");


?>

<?php


session_start();

require 'config.php';


$collectionPertandingan->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);


$_SESSION['success'] = "";

header("Location: pertandingan.php");


?>
?>

<?php


session_start();

require 'config.php';


$collectionPesanan->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);


$_SESSION['success'] = "";

header("Location: pesanan.php");


?>
