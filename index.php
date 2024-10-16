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
    <link rel="stylesheet" href="css/index.css">
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
                            <th>No</th>
                            <th>Gambar Makanan</th>
                            <th>Nama Resep</th>
                            <th>Daerah Khas</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($resep_list)): ?>
                            <tr>
                                <td colspan="6">Tidak ada resep yang ditemukan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($resep_list as $index => $item): ?>
                                <tr>
                                    <td><?php echo $index + 1 ?></td>
                                    <td><img src="uploads/makanan/<?php echo $item['foto']; ?>" alt="Foto item" style="width: 100px;"></td>
                                    <td><?php echo htmlspecialchars($item['nama_resep']); ?></td>
                                    <td><?php echo htmlspecialchars($item['daerah']); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($item['created_at'])); ?></td>
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