<?php
session_start();
include 'db.php';
include 'functions.php';

if (isset($_GET['id'])) {
    $resep = get_resep_by_id($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_resep = $_POST['nama_resep'];
        $description = $_POST['description'];
        $daerah = $_POST['daerah'];
        $bahan = $_POST['bahan'];
        $cara = $_POST['cara'];
        $created_at = $_POST['created_at'];

        update_resep($_GET['id'], $nama_resep, $description, $daerah, $bahan, $cara, $created_at);
        header("Location: halaman_utama.php");
        exit;
    }
} else {
    header("Location: halaman_utama.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
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
            /* background-color: green; */
            height: 100vh;
            margin: auto;
        }

        .container .jumbotron h1 {
            color: #333;
            text-align: center;
            padding: 2rem 0 1rem 0;
        }

        .container .form {
            background-color: #d6bb89;
            max-width: 500px;
            margin: auto;
            border-radius: 5px;
            padding: 1.5rem;
        }

        .container .form form input:focus,
        .container .form form textarea:focus {
            outline: none;
        }

        .container .form form input[type="text"],
        .container .form form input[type="date"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            border: none;
        }

        .container .form form textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            border: none;
        }

        .container .form form .tombol {
            justify-content: space-between;
            display: flex;
        }

        .container .form form .tombol input[type="submit"],
        .container .form form .tombol a {
            background-color: #FFA500;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .container .form form .tombol input[type="submit"]:hover {
            background-color: #af7c1e;
        }

        .container .form form .tombol a {
            text-decoration: none;
            background-color: #666;
        }

        .container .form form .tombol a:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Edit Resep Makanan</h1>

            <div class="form">
                <form action="" method="POST">
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
                        <a href="halaman_utama.php">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>