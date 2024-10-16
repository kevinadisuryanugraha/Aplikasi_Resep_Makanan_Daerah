<?php

function connect_db()
{
    $db = new SQLite3('db_resep_makanan.db');
    return $db;
}

function buat_table()
{
    $db = connect_db();
    $db->exec("CREATE TABLE IF NOT EXISTS resep (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    foto TEXT NOT NULL,
    nama_resep TEXT NOT NULL,
    description TEXT NOT NULL,
    daerah TEXT NOT NULL,
    bahan TEXT NOT NULL, 
    cara TEXT NOT NULL,
    created_at TEXT NOT NULL)");
}

buat_table();
