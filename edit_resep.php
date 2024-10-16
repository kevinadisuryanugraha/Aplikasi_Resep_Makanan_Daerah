<?php
session_start();
include 'db.php';
include 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $resep = get_resep_by_id($id);
    if (!$resep) {
        echo "<script>alert('Resep tidak ditemukan.');
        window.location='index.php';
        </script>";
        exit;
    }
} else {
    echo "<script>alert('ID resep tidak ditemukan.');
    window.location='index.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foto = $_FILES['foto'];
    $nama_resep = $_POST['nama_resep'];
    $description = $_POST['description'];
    $daerah = $_POST['daerah'];
    $bahan = $_POST['bahan'];
    $cara = $_POST['cara'];
    $created_at = $_POST['created_at'];

    $result = update_resep($id, $foto, $nama_resep, $description, $daerah, $bahan, $cara, $created_at);
    if ($result) {
        echo "<script>alert('Resep berhasil diperbarui.');
        window.location='index.php';
        </script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui resep.";
    }
}
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link rel="stylesheet" href="css/edit.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Edit Resep Makanan</h1>

            <div class="form">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="foto">Masukkan gambar</label><br>
                        <input type="file" id="foto" name="foto" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="nama_resep">Nama Resep</label><br>
                        <input type="text" id="nama_resep" name="nama_resep" value="<?php echo htmlspecialchars($resep['nama_resep']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi:</label><br>
                        <textarea id="description" name="description" required><?php echo htmlspecialchars($resep['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="daerah">Daerah:</label><br>
                        <input type="text" id="daerah" name="daerah" value="<?php echo htmlspecialchars($resep['daerah']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="bahan">Bahan:</label><br>
                        <textarea id="bahan" name="bahan" required><?php echo htmlspecialchars($resep['bahan']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cara">Cara Memasak</label><br>
                        <textarea id="cara" name="cara" required><?php echo htmlspecialchars($resep['cara']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="created_at">Dibuat Tanggal:</label><br>
                        <input type="date" id="created_at" name="created_at" value="<?php echo htmlspecialchars($resep['created_at']); ?>" required>
                    </div>

                    <div class="tombol">
                        <input type="submit" value="Edit Resep">
                        <a href="index.php">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>