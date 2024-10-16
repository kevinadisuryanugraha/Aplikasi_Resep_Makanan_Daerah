<?php
require_once 'db.php';

function get_all_resep()
{
    $db = connect_db();
    $query = "SELECT * FROM resep";
    $result = $db->query($query);

    if (!$result) {
        return [];
    }

    $res = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $res[] = $row;
    }
    return $res;
}

function add_resep($nama_resep, $description, $daerah, $bahan, $cara, $created_at)
{
    $db = connect_db();
    $nama_resep = $db->escapeString($nama_resep);
    $description = $db->escapeString($description);
    $daerah = $db->escapeString($daerah);
    $bahan = $db->escapeString($bahan);
    $cara = $db->escapeString($cara);

    $db = connect_db();
    $query = "INSERT INTO resep (nama_resep, description, daerah, bahan, cara, created_at) VALUES ('$nama_resep', '$description', '$daerah', '$bahan', '$cara', '$created_at')";
    return $db->exec($query);
}

function get_resep_by_id($id)
{
    $db = connect_db();
    $query = "SELECT * FROM resep WHERE id = $id";
    $result = $db->query($query);
    return $result ? $result->fetchArray(SQLITE3_ASSOC) : false;
}

function update_resep($id, $nama_resep, $description, $daerah, $bahan, $cara, $created_at)
{
    $db = connect_db();
    $query = "UPDATE resep SET nama_resep = '$nama_resep', description = '$description', daerah = '$daerah', bahan = '$bahan', cara = '$cara', created_at = '$created_at' WHERE id = $id";
    return $db->exec($query);
}

function delete_resep($id)
{
    $db = connect_db();
    $query = "DELETE FROM resep WHERE id = $id";
    if ($db->exec($query) === false) {
        return false;
    }
    return true;
}
