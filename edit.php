<?php

// include database connection file
include_once("./config/database.php");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$statement = $mysqli->prepare("SELECT * FROM vehicles WHERE id = ?");
$statement->bind_param("i", $id);
$statement->execute();
$result = $statement->get_result();
$vehicle = $result->fetch_assoc();
$statement->close();

if (!$vehicle) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit | Sistem Parkir</title>

    <!-- Menggunakan Bootstrap dari node_modules -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">

</head>

<body>

    <div class="container mt-5">
        <h1>Selamat Datang di Sistem Parkir</h1>
        <p>Silahkan masukkan data kendaraan anda!</p>

        <!-- BUTTON MODAL -->
        <div class="my-3 d-flex justify-content-end">
            <a href="index.php">
                Kembali
            </a>
        </div>

        <!-- FORM EDIT -->
        <form method="POST" action="service/update.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($vehicle['id']) ?>">
            <div class="mb-3">
                <label for="jenisKendaraan" class="form-label">Jenis Kendaraan</label>
                <select class="form-select" name="jenis_kendaraan" aria-label="Default select example" required>
                    <option value="<?= htmlspecialchars($vehicle['jenis_kendaraan']) ?>" selected><?= htmlspecialchars($vehicle['jenis_kendaraan']) ?></option>
                    <option value="Motor">Motor</option>
                    <option value="Mobil">Mobil</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                <input type="text" class="form-control" id="plat_nomor" name="plat_nomor"
                    value="<?= htmlspecialchars($vehicle['plat_nomor']) ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <!-- Menggunakan Bootstrap JS dari node_modules -->
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>