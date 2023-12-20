
<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $searchUsername = $_POST['searchUsername'];

    $aggregatePipeline = [
        [
            '$lookup' => [
                'from' => 'pengguna',
                'localField' => 'username',
                'foreignField' => 'username',
                'as' => 'penonton'
            ]
        ],
        [
            '$lookup' => [
                'from' => 'Pertandingan',
                'localField' => 'pertandingan_id',
                'foreignField' => 'pertandingan_id',
                'as' => 'jadwal'
            ]
        ],
        [
            '$unwind' => '$penonton'
        ],
        [
            '$unwind' => '$jadwal'
        ],
        [
            '$match' => [
                'username' => $searchUsername
            ]
        ],
        [
            '$project' => [
                'username' => 1,
                'pertandingan_id' => 1,
                'jumlah_tiket' => 1,
                'total_harga' => 1,
                'penonton.nama' => 1,
                'penonton.email' => 1, 
                'jadwal.nama' => 1,
                'jadwal.lokasi' => 1, 
                'jadwal.tanggal' => 1,
            ]
        ]
    ];

    $pesananData = $collectionPesanan->aggregate($aggregatePipeline)->toArray();
} else {
    $pesananData = [];
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Mencari Data Pesanan </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <h1>Mencari Data Pesanan</h1>
        <a href="index.php" class="btn btn-success">kembali</a><br>
        <form method="post">
            <div class="form-group">
                <label for="searchUsername"></label>
                <input type="text" name="searchUsername" class="form-control" id="searchUsername" placeholder='Masukkan Username:' required>
            </div>
            <button type="submit" name="search" class="btn btn-primary">Cari</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Pertandingan ID</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                    <th>Detail Penonton </th>
                    <th>Detail Pertandingan </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesananData as $pesanan) : ?>
                    <tr>
                        <td><?php echo $pesanan->username; ?></td>
                        <td><?php echo $pesanan->pertandingan_id; ?></td>
                        <td><?php echo $pesanan->jumlah_tiket; ?></td>
                        <td>Rp. <?php echo $pesanan->total_harga; ?></td>
                        <td>
                            <?php foreach ($pesanan->penonton as $penontonDetails) : ?>
                                <?php echo json_encode($penontonDetails); ?><br>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach ($pesanan->jadwal as $jadwalDetails) : ?>
                                <?php echo json_encode($jadwalDetails); ?><br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

</html>
