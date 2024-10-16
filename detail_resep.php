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
    <link rel="stylesheet" href="css/detail.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Resep Makanan Cepat Saji</h1>

            <div class="card">
                <h3>Nama Resep: <?php echo htmlspecialchars($resep['nama_resep']); ?></h3>
                <span>Dibuat Tanggal: <?php echo date('d-m-Y', strtotime($resep['created_at'])); ?></span>


                <div class="isi">
                    <p>
                        <strong>Gambar Makanan:</strong><br> <img src="uploads/makanan/<?php echo $resep['foto']; ?>" alt="Foto Resep" style="width: 100px;">
                    </p>
                </div>

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
                    <a href="index.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>