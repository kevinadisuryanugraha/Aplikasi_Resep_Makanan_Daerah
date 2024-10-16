<?php
session_start();
require_once 'functions.php';

$resep_list = get_all_resep();

if ($resep_list === false) {
    echo "<p>Gagal mengambil resep. Pastikan tabel 'resep' sudah ada di database.</p>";
    exit();
} elseif (!is_array($resep_list)) {
    echo "<p>Data yang diterima bukan array. Diterima: " . gettype($resep_list) . "</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Makanan Cepat Saji</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .container .jumbotron .navigasi {
            justify-content: space-between;
            display: flex;
            padding: 1rem 0rem;
        }

        .container .jumbotron .navigasi .link-navigasi a {
            margin-left: 1rem;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .container .jumbotron .table {
            margin-top: 1rem;
        }

        .container .jumbotron .table table {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }

        .container .jumbotron .table table th {
            background-color: #d6bb89;
        }

        .container .jumbotron .table table th,
        .container .jumbotron .table table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #5d5c5c;
        }

        .container .jumbotron .table tr td a:first-child {
            padding: 5px 20px;
            background-color: #6EC207;
            color: #fff;
            border-radius: 3px;
            text-decoration: none;
            transition: 0.3s ease-in-out;
        }

        .container .jumbotron .table tr td a:first-child:hover {
            background-color: #509C18;
        }

        .container .jumbotron .table tr td #edit,
        .container .jumbotron .table tr td #Hapus {
            padding: 5px 10px;
            border-radius: 3px;
            color: #fff;
        }

        .container .jumbotron .table tr td #edit {
            background-color: #FFA500;
        }

        .container .jumbotron .table tr td #Hapus {
            background-color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Resep Makanan Daerah</h1>

            <div class="navigasi">
                <h3>Daftar Resep</h3>
                <div class="link-navigasi">
                    <a href="tambah_resep.php">Tambah Resep</a>
                </div>
            </div>

            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Resep</th>
                            <th>Daerah Khas</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($resep_list)): ?>
                            <tr>
                                <td colspan="3">Tidak ada resep yang ditemukan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($resep_list as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['nama_resep']); ?></td>
                                    <td><?php echo htmlspecialchars($item['daerah']); ?></td>
                                    <td><?php echo htmlspecialchars($item['created_at']); ?></td>
                                    <td>|
                                        <a href="detail_resep.php?id=<?php echo htmlspecialchars($item['id']); ?>">Detail</a>
                                        |
                                        <a id="edit" href="edit_resep.php?id=<?php echo htmlspecialchars($item['id']); ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                                        |
                                        <a id="Hapus" href="delete_resep.php?id=<?php echo htmlspecialchars($item['id']); ?>" onclick="return confirm('Anda yakin ingin menghapus resep ini?');"><i class="fa-solid fa-trash"></i></a>
                                        |
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>