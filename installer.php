<?php 
// 1. Koneksi ke database mysql
$hostname = "localhost";
$username = "root";
$password = "";

$db = new mysqli($hostname, $username, $password);

// cek kondisi
if ($db->connect_error) {
    die("Koneksi gagal" . $db->connect_error);
} else {
    echo "Koneksi berhasil" . "<br>";
}

// 2. buat database jika belum ada
$sql_buat_db = "CREATE DATABASE IF NOT EXISTS db_resep_makanan";
$eksekusi_buat_db = $db->query($sql_buat_db);

if ($eksekusi_buat_db) {
    echo "database 'db_resep_makanan' berhasil dibuat atau sudah ada" . "<br>";
} else {
    die("Gagal membuat database: " . $db->error);
}

// 3. pilih database
$sql_masuk_db = "USE db_rekomendasi_pkl";
$eksekusi_masuk_db = $db->query($sql_masuk_db);

if ($eksekusi_masuk_db) {
    echo "Berhasil masuk ke database db_rekomendasi_pkl";
} else {
    die("Gagal masuk database: " . $db->error);
}

// 4. Buat tabel 'users' jika belum ada
$sql_buat_tabel_users = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
$eksekusi_buat_tabel_users = $db->query($sql_buat_tabel_users);

if ($eksekusi_buat_tabel_users) {
    echo "Berhasil membuat tabel users";
} else {
    die("Gagal Membuat tabel users: " . $db->error);
}

// 5. Buat tabel resep dengan kolom id user
$sql_buat_tabel_resep = "CREATE TABLE IF NOT EXISTS resep (
        id INT PRIMARY KEY AUTO_INCREMENT,
        foto TEXT NOT NULL,
        nama_resep TEXT NOT NULL,
        description TEXT NOT NULL,
        daerah TEXT NOT NULL,
        bahan TEXT NOT NULL, 
        cara TEXT NOT NULL,
        user_id INT NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$eksekusi_buat_tabel_resep = $db->query($sql_buat_tabel_resep);

if ($eksekusi_buat_tabel_resep) {
    echo "Berhasil membuat tabel resep";
} else {
    die("Gagal membuat tabel resep: " . $db->error);
}

