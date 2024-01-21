<?php
// include database connection file
include_once("../config/database.php");

session_start();

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $jenisKendaraan = $_POST['jenis_kendaraan'];
    $platNomor = $_POST['plat_nomor'];

    if (!$id) {
        $_SESSION['error_message'] = "Data tidak ditemukan.";
    } else {
        $updateStatement = $mysqli->prepare("UPDATE vehicles SET jenis_kendaraan = ?, plat_nomor = ? WHERE id = ?");
        $updateStatement->bind_param("ssi", $jenisKendaraan, $platNomor, $id);
        $updateStatement->execute();
        $updateStatement->close();

        $_SESSION['success_message'] = "Data berhasil diperbarui.";
    }
} else {
    $_SESSION['error_message'] = "Data yang anda masukkan tidak valid.";
}

header("Location: ../index.php");
exit;