<?php
session_start();
require_once 'functions.php';

if (!isset($_GET['id'])) {
    echo "<p>ID resep tidak valid.</p>";
    exit();
}

$id_resep = $_GET['id'];

$resep = get_resep_by_id($id_resep);

if (!$resep) {
    echo "<p>Resep tidak ditemukan.</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep Makanan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #FFECC8;
        }

        .container .jumbotron {
            max-width: 900px;
            margin: auto;
            padding-bottom: 3rem;
        }

        .container .jumbotron h1 {
            color: #333;
            text-align: center;
            padding: 2rem 0 1rem 0;
        }

        .container .jumbotron .card .isi {
            margin-top: 2rem;
        }

        .container .jumbotron .card .tombol {
            margin-top: 2rem;
        }

        .container .jumbotron .card .tombol a {
            background-color: #333;
            text-decoration: none;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .container .jumbotron .card .tombol a:hover {
            text-decoration: none;
            background-color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Resep Makanan Cepat Saji</h1>

            <div class="card">
                <h3>Nama Resep: <?php echo htmlspecialchars($resep['nama_resep']); ?></h3>
                <span>Dibuat Tanggal: <?php echo htmlspecialchars($resep['created_at']); ?></span>

                <div class="isi">
                    <p>
                        <strong>Deskripsi:</strong><br> <?php echo htmlspecialchars($resep['description']); ?>
                    </p>
                </div>

                <div class="isi">
                    <p>
                        <strong>Bahan-bahan:</strong><br> <?php echo htmlspecialchars($resep['bahan']); ?>
                    </p>
                </div>

                <div class="isi">
                    <p>
                        <strong>Langkah-langkah:</strong><br> <?php echo nl2br(htmlspecialchars($resep['cara'])); ?>
                    </p>
                </div>

                <div class="tombol">
                    <a href="halaman_utama.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>