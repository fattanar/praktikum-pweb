<?php
session_start();

if(!isset($_SESSION['username'])) {
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
    <title>Data Mustahik Lainnya | Sistem Informasi Zakat</title>
</head>

<body>

    <?php require('nav.php'); ?>

    <?php
    require "security/config.php";

    $query = "SELECT * FROM mustahik_lainnya";
    $result = $conn->query($query);
    ?>

    <div class="table-container">
        <h2>Data Distribusi Zakat Fitrah Lainnya</h2>
        <div class="d-grid col-6 mx-auto">
            <a href="tambah_distribusilainnya.php" class="btn btn-success"><b>===== Tambah Baru =====</b></a>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Hak</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['id_mustahiklainnya']}</td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['kategori']}</td>
                                    <td>{$row['hak']}</td>
                                    <td>
                                        <a href='#' data-bs-toggle='modal' data-bs-target='#readModal{$row['id_mustahiklainnya']}'><i class='bi bi-eye'></i></a>
                                        <a href='#' data-bs-toggle='modal' data-bs-target='#editModal{$row['id_mustahiklainnya']}'><i class='bi bi-pencil'></i></a>
                                        <a href='#' onclick='confirmDelete({$row['id_mustahiklainnya']})'><i class='bi bi-trash'></i></a>
                                    </td>
                                 </tr>";

                        echo "<div class='modal fade' id='readModal{$row['id_mustahiklainnya']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                 <div class='modal-dialog'>
                                     <div class='modal-content'>
                                         <div class='modal-header'>
                                             <h5 class='modal-title' id='exampleModalLabel'>Detail Muzakki</h5>
                                             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                         </div>
                                         <div class='modal-body'>
                                             <p><strong>ID: </strong>{$row['id_mustahiklainnya']}</p>
                                             <p><strong>Nama: </strong> {$row['nama']}</p>
                                             <p><strong>Kategori: </strong> {$row['kategori']}</p>
                                             <p><strong>Hak: </strong> {$row['hak']}</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>";

                             echo "<div class='modal fade' id='editModal{$row['id_mustahiklainnya']}' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                             <div class='modal-dialog'>
                                 <div class='modal-content'>
                                     <div class='modal-header'>
                                         <h5 class='modal-title' id='editModalLabel'>Edit Zakat</h5>
                                         <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                     </div>
                                     <div class='modal-body'>
                                         <form action='distribusilainnya_editprocess.php' method='post'>
                                             <!-- Tambahkan input untuk data yang akan diedit -->
                                             <input type='hidden' name='id' value='{$row['id_mustahiklainnya']}'>
                                             
                                             <label for='edit_nama'>Nama:</label>
                                             <input type='text' name='edit_nama' placeholder='Masukkan nama' value='{$row['nama']}' required>
                                         
                                             <div class='form-group'>
                                                 <label for='edit_kategori'>Kategori</label>
                                                 <br>
                                                 <select name='edit_kategori' id='edit_kategori' onchange='updateKategoriEdit(this)'>
                                                     <option>Pilih</option>
                                                     <option value='amilin' " . ($row['kategori'] === 'amilin' ? 'selected' : '') . ">Amilin</option>
                                                     <option value='fisabilillah' " . ($row['kategori'] === 'fisabilillah' ? 'selected' : '') . ">Fisabilillah</option>
                                                     <option value='mualaf' " . ($row['kategori'] === 'mualaf' ? 'selected' : '') . ">Mualaf</option>
                                                     <option value='ibnu_sabil' " . ($row['kategori'] === 'ibnu_sabil' ? 'selected' : '') . ">Ibnu Sabil</option>
                                                 </select>
                                             </div>
                                         
                                             <div id='edit_hak'>
                                                 <label for='edit_jumlah_hak'>Hak</label>
                                                 <br>
                                                 <input type='number' name='edit_jumlah_hak' placeholder='Masukkan jumlah hak' value='" . (isset($row['jumlah_hak']) ? $row['jumlah_hak'] : '') . "' id='edit_jumlah_hak'>
                                             </div>
                                         
                                             <button type='submit' class='btn btn-primary mt-3' name='edit_submit'>Simpan Perubahan</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>";

                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data yang membayar zakat.</td></tr>";
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
            window.location.href = 'distribusilainnya_deleteprocess.php?id=' + id;
        }
    }

    function updateKategoriEdit(el) {
        const editHakInput = document.getElementById('edit_hak');

        if (el.value === 'amilin' || el.value === 'fisabilillah' || el.value === 'mualaf' || el.value === 'ibnu_sabil') {
            editHakInput.style.display = 'block';
        } else {
            editHakInput.style.display = 'none';
        }
    }

</script>

</html>