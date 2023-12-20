<?php

require_once __DIR__ . "/vendor/autoload.php";

$mongoClient = new MongoDB\Client;
$database = $mongoClient->tiketdatabase;

$collectionPengguna = $database->pengguna;
$collectionPertandingan = $database->Pertandingan;
$collectionPesanan = $database->pesanan;



?>
