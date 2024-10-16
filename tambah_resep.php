<?php
session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_resep = $_POST['nama_resep'];
    $description = $_POST['description'];
    $daerah = $_POST['daerah'];
    $bahan = $_POST['bahan'];
    $cara = $_POST['cara'];
    $created_at = $_POST['created_at'];

    if (isset($_FILES['foto'])) {
        $result = add_resep($_FILES['foto'], $nama_resep, $description, $daerah, $bahan, $cara, $created_at);

        if ($result) {
            echo "<script>alert('Resep Berhasil Ditambahkan');
            window.location='index.php';
            </script>";
        } else {
            echo "Terjadi kesalahan saat menambahkan Resep";
        }
    } else {
        echo "File gambar tidak ditemukan.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep</title>
    <link rel="stylesheet" href="css/tambah.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Tambah Resep Makanan</h1>

            <div class="form">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="foto">Masukkan gambar</label><br>
                        <input type="file" id="foto" name="foto" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="nama_resep">Nama Resep</label><br>
                        <input type="text" id="nama_resep" name="nama_resep" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi:</label><br>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="daerah">Daerah:</label><br>
                        <input type="text" id="daerah" name="daerah" required></input>
                    </div>
                    <div class="form-group">
                        <label for="bahan">Bahan:</label><br>
                        <textarea id="bahan" name="bahan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cara">Cara Memasak</label><br>
                        <textarea id="cara" name="cara" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Tanggal Dibuat:</label><br>
                        <input type="date" id="created_at" name="created_at" required></input>
                    </div>

                    <div class="tombol">
                        <input type="submit" value="Tambah Resep">
                        <a href="index.php">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>