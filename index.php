<?php 
session_start();
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nama'];
    $email = $_POST['email'];

    if (tambah_user($name, $email)) {
        $_SESSION['nama'] = $name;
        $_SESSION['email'] = $email;

        header("Location: halaman_utama.php");
        exit();
    } else {
        echo "Gagal Menambahkan User";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Makanan Cepat Saji</title>
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

        .container {
            height: 100vh;
        }

        .container .card {
            background-color: #333;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);

            left: 50%;
            top: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
        }

        .container .card .form {
            display: inline-block;
            text-align: center;
            margin: 3rem 2rem;
        }

        .container .card .form h1 {
            margin-bottom: 2rem;
            color: white;
        }

        .container .card .form input[type="text"],
        .container .card .form input[type="email"] {
            padding: 1rem 7rem 1rem 1rem;
            border-radius: 5px;
            border: none;
            margin-bottom: 1rem;
        }

        .container .card .form input[type="submit"] {
            background-color: white;
            color: rgb(7, 97, 215);
            padding: 1rem 5rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .container .card .form input[type="submit"]:hover {
            background-color: rgb(17, 61, 119);
            color: white;
        }

        .container .card .form input:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <form class="form" action="" method="POST">
                <h1>Masuk Aplikasi Resep</h1>
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required><br>
                <input type="email" name="email" placeholder="Masukkan Email" required><br>
                <input type="submit" name="submit"><br>
            </form>
        </div>
    </div>
</body>

</html>