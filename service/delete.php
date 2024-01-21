<?php
// include database connection file
include_once("../config/database.php");

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Periksa apakah kendaraan sudah keluar (jam_keluar tidak null)
    $checkStatement = $mysqli->prepare("SELECT jam_keluar FROM vehicles WHERE id = ?");
    $checkStatement->bind_param("i", $id);
    $checkStatement->execute();
    $checkResult = $checkStatement->get_result();
    $vehicle = $checkResult->fetch_assoc();
    $checkStatement->close();

    // Hanya izinkan penghapusan jika kendaraan belum keluar
    $deleteStatement = $mysqli->prepare("DELETE FROM vehicles WHERE id = ?");
    $deleteStatement->bind_param("i", $id);

    if ($deleteStatement->execute()) {
        $_SESSION['success_message'] = "Data berhasil dihapus.";
    } else {
        $_SESSION['error_message'] = "Data gagal dihapus.";   
    }
} else {
    $_SESSION['error_message'] = "Data tidak ditemukan.";   
}

header("Location: ../index.php");
exit;