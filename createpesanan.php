<?php
session_start();

if (isset($_POST['submit'])) {
    require 'config.php';

    $username = $_POST['username'];
    $pertandingan_id = $_POST['pertandingan_id'];

    // Konversi nilai ke tipe data integer
    $jumlah_tiket = intval($_POST['jumlah_tiket']);

    $pertandingan = $collectionPertandingan->findOne(['pertandingan_id' => $pertandingan_id]);

    // Calculate total harga as a decimal
    $total_harga = bcmul($jumlah_tiket, $pertandingan->harga, 2); // Change 2 to the desired precision

    // Ensure total_harga is a decimal
    $total_harga = (float)$total_harga;

    $insertOneResult = $collectionPesanan->insertOne([
        'username' => $username,
        'pertandingan_id' => $pertandingan_id,
        'jumlah_tiket' => $jumlah_tiket,
        'total_harga' => $total_harga,
    ]);

    $_SESSION['success'] = "";
    header("Location: pesanan.php");
}
?>


<!DOCTYPE html>

<html>

<head>

    <title>Pengelolaan </title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <script>
        // JavaScript function to update total harga based on jumlah_tiket
        function updateTotalHarga() {
            var jumlah_tiket = document.getElementById('jumlah_tiket').value;
            var pertandingan_id = document.getElementById('pertandingan_id').value;

            // Fetch the harga from the server (you may need to use AJAX for this)
            var pertandingan_harga = <?php echo json_encode($pertandingan->harga); ?>;

            // Calculate total harga
            var total_harga = jumlah_tiket * pertandingan_harga;

            // Update the total_harga input field
            document.getElementById('total_harga').value = total_harga;
        }
    </script>

</head>

<body>

<div class="container">

    <h1>Tambah Data</h1>

    <a href="pesanan.php" class="btn btn-primary">kembali</a>

    <form method="POST">
        <div class="form-group">
            <strong>Username:</strong>
            <input type="text" name="username" required="" class="form-control" placeholder="Username">
        </div>

        <label for="pertandingan_id">Pertandingan ID:</label>
        <select name="pertandingan_id" id="pertandingan_id" class="form-control" onchange="updateTotalHarga()">
            <?php
            // Connect to MongoDB and retrieve Pertandingans
            require 'config.php';
            $Pertandingans = $collectionPertandingan->find([]);

            // Loop through Pertandingans to create options in the dropdown
            foreach ($Pertandingans as $Pertandingan) {
                echo "<option value='" . $Pertandingan->pertandingan_id . "'>" . $Pertandingan->nama . "</option>";
            }
            ?>
        </select>

        <div class="form-group">
            <strong>Jumlah Tiket :</strong>
            <!-- Menggunakan input type number -->
            <input type="number" id="jumlah_tiket" name="jumlah_tiket" required="" class="form-control" placeholder="jumlah_Tiket" onchange="updateTotalHarga()">
        </div>

        <div class="form-group">
            <strong>Total Harga:</strong>
            <input type="text" id="total_harga" name="total_harga" readonly class="form-control" placeholder="Total Harga Akan Terhitung Otomatis">
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>
    </form>

</div>

</body>

</html>
