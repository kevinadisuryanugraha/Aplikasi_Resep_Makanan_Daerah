<?php
require_once 'config.php';

function connect_db() {
    $db = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if ($db->connect_error) {
        die("Koneksi gagal: " . $db->connect_error);
    }

    return $db;
}

function buat_table() {
    $db = connect_db();

    // Membuat tabel resep dengan kolom user_id
    $query_resep = "CREATE TABLE IF NOT EXISTS resep (
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

    if ($db->query($query_resep) === TRUE) {
        // echo "Tabel 'resep' berhasil dibuat atau sudah ada.<br>";
    } else {
        echo "Error saat membuat tabel 'resep': " . $db->error . "<br>";
    }

    // Membuat tabel user
    $query_user = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
    )";

    if ($db->query($query_user) === TRUE) {
        // echo "Tabel 'user' berhasil dibuat atau sudah ada.<br>";
    } else {
        echo "Error saat membuat tabel 'user': " . $db->error . "<br>";
    }

    $db->close();
}

buat_table();
