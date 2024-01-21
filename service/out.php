<?php
// include database connection file
include_once("../config/database.php");

session_start();

if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = "Data tidak ditemukan.";
} else {
    $id = $_GET['id'];
    
    $statement = $mysqli->prepare("UPDATE vehicles SET jam_keluar = NOW() WHERE id = ?");
    $statement->bind_param("i", $id);
    
    if ($statement->execute()) {
        $_SESSION['success_message'] = "Kendaraan berhasil keluar.";
    } else {
        $_SESSION['error_message'] = "Kendaraan gagal keluar.";
    }
}

header("Location: ../index.php");
exit;