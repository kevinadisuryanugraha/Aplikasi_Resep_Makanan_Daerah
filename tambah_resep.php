<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['nama']) || !isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$user_name = $_SESSION['nama'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_resep = $_POST['nama_resep'];
    $description = $_POST['description'];
    $daerah = $_POST['daerah'];
    $bahan = $_POST['bahan'];
    $cara = $_POST['cara'];

    if (add_resep($nama_resep, $description, $daerah, $bahan, $cara, $user_name)) {
        header("Location: halaman_utama.php");
        exit();
    } else {
        echo "Gagal menambahkan resep. Coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep</title>
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

        .container .form form input[type="text"] {
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
            <h1>Tambah Resep Makanan</h1>

            <div class="form">
                <form action="" method="POST">
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

                    <div class="tombol">
                        <input type="submit" value="Tambah Resep">
                        <a href="halaman_utama.php">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>