<?php
// include database connection file
include_once("../config/database.php");

session_start();

if (!isset($_POST['submit'])) {
    // DATA POST
    $jenisKendaraan = $_POST['jenis_kendaraan'];
    $platNomor = $_POST['plat_nomor'];
    
    // Insert user data into table
    $statement = $mysqli->prepare("INSERT INTO vehicles (jenis_kendaraan, plat_nomor, jam_masuk) VALUES (?, ?, CURRENT_TIMESTAMP)");

    // Bind parameter ke statement
    $statement->bind_param("ss", $jenisKendaraan, $platNomor);

    if ($statement->execute()) {
        // Jika eksekusi berhasil, set pesan sukses
        $_SESSION['success_message'] = "Data berhasil ditambahkan.";
    } else {
        $_SESSION['error_message'] = "Data gagal ditambahkan.";
    }

    // Tutup statement
    $statement->close();

} else {
    $_SESSION['error_message'] = "Data yang anda masukkan tidak valid.";    
}
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;