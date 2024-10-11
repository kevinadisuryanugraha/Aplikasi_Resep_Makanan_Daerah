<?php
session_start();
include 'db.php';
include 'functions.php';

if (isset($_GET['id'])) {
    $resep = get_resep_by_id($_GET['id']);

    if ($resep && $resep['created_by'] === $_SESSION['nama']) {
        delete_resep($_GET['id']);
    }
}

header("Location: index.php");
exit;
