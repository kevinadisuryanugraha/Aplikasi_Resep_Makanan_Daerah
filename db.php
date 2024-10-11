<?php

function connect_db() 
{
    $db = new SQLite3('resep_makanan.db');
    return $db;
}

function buat_table() {
    $db = connect_db();
    $db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    email TEXT NOT NULL)");

    $db->exec("CREATE TABLE IF NOT EXISTS resep (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_resep TEXT NOT NULL,
    description TEXT NOT NULL,
    daerah TEXT NOT NULL,
    bahan TEXT NOT NULL, 
    cara TEXT NOT NULL,
    created_by TEXT NOT NULL)");
}

buat_table();

?>