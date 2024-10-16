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

function add_resep($foto, $nama_resep, $description, $daerah, $bahan, $cara, $created_at)
{
    if (!isset($foto) || $foto['error'] != UPLOAD_ERR_OK) {
        echo "Tidak ada file yang diupload atau terjadi kesalahan saat mengupload.";
        return false;
    }

    $db = connect_db();
    $target_dir = "uploads/makanan/";
    $file_name = basename($foto["name"]);
    $target_file = $target_dir . $file_name;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($foto["tmp_name"]);
    if ($check === false) {
        echo "File yang diupload bukan gambar.";
        return false;
    }

    if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png") {
        echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
        return false;
    }

    if ($foto["size"] > 2000000) {
        echo "Ukuran file terlalu besar. Maksimal 2MB.";
        return false;
    }

    if (move_uploaded_file($foto["tmp_name"], $target_file)) {
        $query = "INSERT INTO resep (foto, nama_resep, description, daerah, bahan, cara, created_at) 
                  VALUES ('$file_name', '$nama_resep', '$description', '$daerah', '$bahan', '$cara', '$created_at')";
        $result = $db->exec($query);
        return $result;
    } else {
        echo "Terjadi kesalahan saat mengupload gambar.";
        return false;
    }
}



function get_resep_by_id($id)
{
    $db = connect_db();
    $query = "SELECT * FROM resep WHERE id = $id";
    $result = $db->query($query);
    return $result ? $result->fetchArray(SQLITE3_ASSOC) : false;
}

function update_resep($id, $foto, $nama_resep, $description, $daerah, $bahan, $cara, $created_at)
{
    $db = connect_db();
    $id = (int)$id;
    $query = "UPDATE resep SET nama_resep = '$nama_resep', description = '$description', daerah = '$daerah', 
              bahan = '$bahan', cara = '$cara', created_at = '$created_at'";

    if (!empty($foto["name"])) {
        $target_dir = "uploads/makanan/";
        $file_name = basename($foto["name"]);
        $target_file = $target_dir . $file_name;

        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($foto["tmp_name"]);
        if ($check === false) {
            echo "File yang diupload bukan gambar.";
            return false;
        }

        if ($image_file_type != "jpg" && $image_file_type != "jpeg" && $image_file_type != "png") {
            echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
            return false;
        }

        if (move_uploaded_file($foto["tmp_name"], $target_file)) {
            $query .= ", foto = '$file_name'";
        } else {
            echo "Terjadi kesalahan saat mengupload gambar.";
            return false;
        }
    }

    $query .= " WHERE id = $id";
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
