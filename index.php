<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Parkir</title>

    <!-- Menggunakan Bootstrap dari node_modules -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">

</head>

<body>

    <div class="container mt-5">
        <h1>Selamat Datang di Sistem Parkir</h1>
        <p>Silahkan masukkan data kendaraan anda!</p>

        <?php
        session_start();
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success" role="alert">';
            echo htmlspecialchars($_SESSION['success_message']);
            echo '</div>';

            // Hapus pesan keberhasilan setelah ditampilkan
            unset($_SESSION['success_message']);
        } else if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-danger" role="alert">';
            echo htmlspecialchars($_SESSION['error_message']);
            echo '</div>';

            // Hapus pesan keberhasilan setelah ditampilkan
            unset($_SESSION['error_message']);
        }
        ?>

        <!-- BUTTON MODAL -->
        <div class="my-3 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
            </button>
        </div>

        <!-- TABLE DATA -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Jenis Kendaraan</th>
                    <th scope="col">Plat Nomor</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Keluar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection file
                include_once("./config/database.php");

                $result = mysqli_query($mysqli, "SELECT * FROM vehicles");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jenis_kendaraan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['plat_nomor']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jam_masuk']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jam_keluar']) . "</td>";
                        echo '<td class="px-2">';
                        if (is_null($row['jam_keluar'])) {
                            echo '<a href="service/out.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-success mx-1">Keluar</a>';
                        }
                        echo '<a href="edit.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-warning mx-1">Edit</a>';
                        echo '<a href="service/delete.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger mx-1">Hapus</a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Display a message if there are no records
                    echo "<tr><td colspan='6'>Tidak ada data.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- MODAL FORM -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir Anda dapat ditambahkan di sini -->
                        <form action="service/create.php" method="POST" id="formAddData">
                            <div class="mb-3">
                                <label for="jenisKendaraan" class="form-label">Jenis Kendaraan</label>
                                <select class="form-select" name="jenis_kendaraan" aria-label="Default select example"
                                    required>
                                    <option selected value="">Masukkan Jenis Kendaraan</option>
                                    <option value="Motor">Motor</option>
                                    <option value="Mobil">Mobil</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="platNomor" class="form-label">Plat Nomor</label>
                                <input type="text" class="form-control" id="platNomor" placeholder="Masukkan Plat Nomor"
                                    name="plat_nomor" required>
                            </div>
                            <!-- Tambahan elemen formulir dapat ditambahkan di sini -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Menggunakan Bootstrap JS dari node_modules -->
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>