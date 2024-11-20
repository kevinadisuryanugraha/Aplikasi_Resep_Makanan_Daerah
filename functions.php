<?php
require_once 'db.php';

function register_user($username, $email, $password)
{
    $db = connect_db();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query_check = "SELECT * FROM user WHERE email = ?";
    $stmt_check = $db->prepare($query_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $stmt_check->close();
        $db->close();
        return "Email sudah terdaftar.";
    }
    $stmt_check->close();

    $query = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt === false) {
        echo "Error: " . $db->error;
        $db->close();
        return false;
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $result = $stmt->execute();

    $stmt->close();
    $db->close();

    if ($result) {
        return true;
    } else {
        return "Pendaftaran gagal. Silakan coba lagi.";
    }
}

function login_user($email, $password)
{
    $db = connect_db();

    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $stmt->close();
            $db->close();

            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            return true;
        } else {
            $stmt->close();
            $db->close();
            return "Password salah.";
        }
    } else {
        $stmt->close();
        $db->close();
        return "Email tidak ditemukan.";
    }
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
    while ($row = $result->fetch_assoc()) {
        $res[] = $row;
    }

    $db->close();
    return $res;
}

function add_resep($foto, $nama_resep, $description, $daerah, $bahan, $cara, $created_at)
{
    // Memastikan user sudah login dan session user_id ada
    if (!isset($_SESSION['user_id'])) {
        echo "Anda harus login terlebih dahulu.";
        return false;
    }

    $user_id = $_SESSION['user_id']; // Mengambil user_id dari session

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
        $query = "INSERT INTO resep (foto, nama_resep, description, daerah, bahan, cara, created_at, user_id) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);

        if ($stmt === false) {
            echo "Error: " . $db->error;
            $db->close();
            return false;
        }

        $stmt->bind_param("sssssisi", $file_name, $nama_resep, $description, $daerah, $bahan, $cara, $created_at, $user_id);

        $result = $stmt->execute();
        if ($result === false) {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $db->close();
        return $result;
    } else {
        echo "Terjadi kesalahan saat mengupload gambar.";
        return false;
    }
}

function get_resep_by_id($id)
{
    $db = connect_db();
    $query = "SELECT * FROM resep WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_assoc();
    $stmt->close();
    $db->close();
    return $data;
}

function update_resep($id, $foto, $nama_resep, $description, $daerah, $bahan, $cara, $created_at)
{
    $db = connect_db();
    $query = "UPDATE resep SET nama_resep = ?, description = ?, daerah = ?, bahan = ?, cara = ?, created_at = ?";

    $file_name = null;
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
            $query .= ", foto = ?";
        } else {
            echo "Terjadi kesalahan saat mengupload gambar.";
            return false;
        }
    }

    $query .= " WHERE id = ?";
    $stmt = $db->prepare($query);

    if ($file_name) {
        $stmt->bind_param("sssssssi", $nama_resep, $description, $daerah, $bahan, $cara, $created_at, $file_name, $id);
    } else {
        $stmt->bind_param("ssssssi", $nama_resep, $description, $daerah, $bahan, $cara, $created_at, $id);
    }

    $result = $stmt->execute();
    $stmt->close();
    $db->close();
    return $result;
}

function delete_resep($id)
{
    $db = connect_db();
    $query = "DELETE FROM resep WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    $stmt->close();
    $db->close();
    return $result;
}
