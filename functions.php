<?php
require_once 'db.php';

function check_user($name, $email)
{
    $db = connect_db();
    $query = "SELECT * FROM users WHERE nama = '$name' AND email = '$email'";
    $result = $db->query($query);

    return $result && $result->fetchArray(SQLITE3_ASSOC);
}

function tambah_user($name, $email)
{
    if (check_user($name, $email)) {
        return true;
    }

    $db = connect_db();
    $query = "INSERT INTO users (nama, email) VALUES ('$name', '$email')";
    return $db->exec($query);
}

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

function add_resep($nama_resep, $description, $daerah, $bahan, $cara, $created_by)
{
    $db = connect_db();
    $query = "INSERT INTO resep (nama_resep, description, daerah, bahan, cara, created_by) VALUES ('$nama_resep', '$description', '$daerah', '$bahan', '$cara', '$created_by')";
    return $db->exec($query);
}

function get_resep_by_id($id)
{
    $db = connect_db();
    $query = "SELECT * FROM resep WHERE id = $id";
    $result = $db->query($query);
    return $result ? $result->fetchArray(SQLITE3_ASSOC) : false;
}

function update_resep($id, $nama_resep, $description, $daerah, $bahan, $cara)
{
    $db = connect_db();
    $query = "UPDATE resep SET nama_resep = '$nama_resep', description = '$description', daerah = '$daerah', bahan = '$bahan', cara = '$cara' WHERE id = $id";
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
