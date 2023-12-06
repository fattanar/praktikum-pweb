<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Terminate script execution after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Data Muzakki | Sistem Informasi Zakat</title>
</head>

<body>

    <?php require('nav.php'); ?>

    <?php
    require "security/config.php";

    $query = "SELECT * FROM muzakki";
    $result = $conn->query($query);
    ?>

    <div class="table-container">
        <h2>Data Muzakki</h2>
        <div class="d-grid col-6 mx-auto">
            <a href="tambah_muzakki.php" class="btn btn-success"><b>===== Tambah Baru =====</b></a>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Muzakki</th>
                    <th>Jumlah Tanggungan</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['id_muzakki']}</td>
                                    <td>{$row['nama_muzakki']}</td>
                                    <td>{$row['jumlah_tanggungan']}</td>
                                    <td>{$row['keterangan']}</td>
                                    <td>
                                        <a href='#' data-bs-toggle='modal' data-bs-target='#readModal{$row['id_muzakki']}'><i class='bi bi-eye'></i></a>
                                        <a href='#' data-bs-toggle='modal' data-bs-target='#editModal{$row['id_muzakki']}'><i class='bi bi-pencil'></i></a>
                                        <a href='#' onclick='confirmDelete({$row['id_muzakki']})'><i class='bi bi-trash'></i></a>
                                    </td>
                                 </tr>";

                        echo "<div class='modal fade' id='readModal{$row['id_muzakki']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                 <div class='modal-dialog'>
                                     <div class='modal-content'>
                                         <div class='modal-header'>
                                             <h5 class='modal-title' id='exampleModalLabel'>Detail Muzakki</h5>
                                             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                         </div>
                                         <div class='modal-body'>
                                             <p><strong>ID:</strong>{$row['id_muzakki']}</p>
                                             <p><strong>Nama Muzakki:</strong> {$row['nama_muzakki']}</p>
                                             <p><strong>Jumlah Tanggungan:</strong> {$row['jumlah_tanggungan']}</p>
                                             <p><strong>Keterangan:</strong> {$row['keterangan']}</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>";

                        echo "<div class='modal fade' id='editModal{$row['id_muzakki']}' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                             <div class='modal-dialog'>
                                 <div class='modal-content'>
                                     <div class='modal-header'>
                                         <h5 class='modal-title' id='editModalLabel'>Edit Muzakki</h5>
                                         <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                     </div>
                                     <div class='modal-body'>
                                         <!-- Form Edit Muzakki dapat dimasukkan di sini -->
                                         <form action='muzakki_editprocess.php' method='post'>
                                             <input type='hidden' name='id_muzakki' value='{$row['id_muzakki']}'>
                                             <label for='edit_nama'>Nama Muzakki:</label>
                                             <input type='text' id='edit_nama' name='edit_nama' value='{$row['nama_muzakki']}' required>
                                             
                                             <label for='edit_tanggungan'>Jumlah Tanggungan:</label>
                                             <input type='number' id='edit_tanggungan' name='edit_tanggungan' value='{$row['jumlah_tanggungan']}' required>
                                             
                                             <label for='edit_keterangan'>Keterangan:</label>
                                             <input type='text' id='edit_keterangan' name='edit_keterangan' value='{$row['keterangan']}' required>
                                             
                                             <button type='submit' class='btn btn-primary mt-3'>Simpan Perubahan</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>";

                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data Muzakki.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</body>

<script>
    function confirmDelete(id) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
        if (confirmation) {
            window.location.href = 'muzakki_deleteprocess.php?id=' + id;
        }
    }
</script>

</html>