<!DOCTYPE html>
<html lang="en">
<head>
    <title>header Admin</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        header {
            background-color: #007bff; /* Warna latar belakang biru */
            padding: 20px;
            color: #fff; /* Warna teks putih */
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 10px;
        }

        nav a {
            text-decoration: none;
            color: #fff; /* Warna teks putih */
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #2980b9; /* Warna latar belakang biru muda pada hover */
        }
    </style>
</head>
<body>
    <header>

        <nav>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="pengguna.php">Data Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pertandingan.php">Data Pertandingan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pesanan.php">Data Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lookup.php">Cari</a>
                </li>
            </ul>
        </nav>
    </header>
</body>
</html>
