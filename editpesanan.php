<?php
session_start();
require 'config.php';

use MongoDB\BSON\Decimal128;
use MongoDB\BSON\ObjectId;

if (isset($_GET['id'])) {
    $pesanan = $collectionPesanan->findOne(['_id' => new ObjectId($_GET['id'])]);
}

if (isset($_POST['submit'])) {
    // Convert input values to MongoDB\BSON\Decimal128
    $jumlah_tiket = new Decimal128($_POST['jumlah_tiket']);
    
    // Retrieve the pertandingan document
    $pertandingan = $collectionPertandingan->findOne(['pertandingan_id' => $_POST['pertandingan_id']]);
    
    // Calculate total harga based on jumlah_tiket and pertandingan harga
    $total_harga = new Decimal128(bcmul($jumlah_tiket->__toString(), $pertandingan->harga, 0));

    // Mengirim hasil update ke MongoDB
    $collectionPesanan->updateOne(
        ['_id' => new ObjectId($_GET['id'])],
        [
            '$set' => [
                'username' => $_POST['username'],
                'pertandingan_id' => $_POST['pertandingan_id'],
                'jumlah_tiket' => $jumlah_tiket,
                'total_harga' => $total_harga,
            ]
        ]
    );

    if (isset($_SESSION['success'])) {
        echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
        unset($_SESSION['success']); // Pesan sementara
    }

    header("Location: pesanan.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Pesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h1>Ubah Data Pesanan</h1>
    <a href="pesanan.php" class="btn btn-primary">Kembali</a>
    <form method="POST">
        <div class="form-group">
            <strong>Username:</strong>
            <input type="text" name="username" value="<?php echo $pesanan->username; ?>" required=""
                   class="form-control" placeholder="Username">
        </div>

        <select name="pertandingan_id" class="form-control" onchange="updateTotalHarga()">
            <?php
            // Connect to MongoDB and retrieve Pertandingans
            require 'config.php';
            $Pertandingans = $collectionPertandingan->find([]);

            // Loop through Pertandingans to create options in the dropdown
            foreach ($Pertandingans as $Pertandingan) {
                $selected = ($Pertandingan->pertandingan_id == $pesanan->pertandingan_id) ? 'selected' : '';
                echo "<option value='" . $Pertandingan->pertandingan_id . "' data-harga='" . $Pertandingan->harga . "' $selected>" . $Pertandingan->nama . "</option>";
            }
            ?>
        </select>

        <div class="form-group">
            <strong>Jumlah Tiket:</strong>
            <input type="text" name="jumlah_tiket" id="jumlah_tiket" value="<?php echo $pesanan->jumlah_tiket; ?>" required=""
                   class="form-control" placeholder="Jumlah Tiket" oninput="updateTotalHarga()">
        </div>

        <div class="form-group">
            <strong>Total Harga:</strong>
            <input type="text" name="total_harga" id="total_harga" value="<?php echo $pesanan->total_harga; ?>" readonly
                   class="form-control" placeholder="Total Harga">
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Kirim</button>
        </div>
    </form>
</div>

<script>
    // JavaScript function to update total harga based on jumlah_tiket
    function updateTotalHarga() {
        var jumlah_tiket = document.getElementById('jumlah_tiket').value;
        var pertandingan_id = document.getElementsByName('pertandingan_id')[0];
        var selectedPertandingan = pertandingan_id.options[pertandingan_id.selectedIndex];
        var pertandingan_harga = selectedPertandingan.getAttribute('data-harga');

        // Calculate total harga
        var total_harga = parseFloat(jumlah_tiket) * parseFloat(pertandingan_harga);

        // Update the total_harga input field
        document.getElementById('total_harga').value = total_harga.toFixed(0); // Adjust precision as needed
    }

    // Initial call to set total_harga on page load
    updateTotalHarga();
</script>

</body>
</html>
