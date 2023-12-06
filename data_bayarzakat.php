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
    <title>Data Pengumpulan Zakat | Sistem Informasi Zakat</title>
</head>

<body>

    <?php require('nav.php'); ?>

    <?php
    require "security/config.php";

    $query = "SELECT * FROM bayarzakat";
    $result = $conn->query($query);
    ?>

    <div class="table-container">
        <h2>Data Pengumpulan Zakat FItrah</h2>
        <div class="d-grid col-6 mx-auto">
            <a href="bayar_zakat.php" class="btn btn-success"><b>===== Tambah Baru =====</b></a>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama KK</th>
                    <th>Jumlah Tanggungan</th>
                    <th>Jenis Bayar</th>
                    <th>Jumlah Tanggungan Yang Dibayar</th>
                    <th>Beras</th>
                    <th>Uang</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['id_zakat']}</td>
                                    <td>{$row['nama_kk']}</td>
                                    <td>{$row['jumlah_tanggungan']}</td>
                                    <td>{$row['jenis_bayar']}</td>
                                    <td>{$row['jumlah_tanggunganyangdibayar']}</td>
                                    <td>{$row['bayar_beras']}</td>
                                    <td>{$row['bayar_uang']}</td>
                                    <td>
                                        <a href='#' data-bs-toggle='modal' data-bs-target='#readModal{$row['id_zakat']}'><i class='bi bi-eye'></i></a>
                                        <a href='#' data-bs-toggle='modal' data-bs-target='#editModal{$row['id_zakat']}'><i class='bi bi-pencil'></i></a>
                                        <a href='#' onclick='confirmDelete({$row['id_zakat']})'><i class='bi bi-trash'></i></a>
                                    </td>
                                 </tr>";

                        echo "<div class='modal fade' id='readModal{$row['id_zakat']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                 <div class='modal-dialog'>
                                     <div class='modal-content'>
                                         <div class='modal-header'>
                                             <h5 class='modal-title' id='exampleModalLabel'>Detail Muzakki</h5>
                                             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                         </div>
                                         <div class='modal-body'>
                                             <p><strong>ID:</strong>{$row['id_zakat']}</p>
                                             <p><strong>Nama KK:</strong> {$row['nama_kk']}</p>
                                             <p><strong>Jumlah Tanggungan:</strong> {$row['jumlah_tanggungan']}</p>
                                             <p><strong>Jenis Bayar:</strong> {$row['jenis_bayar']}</p>
                                             <p><strong>Jumlah Tanggungan yang Dibayar:</strong> {$row['jumlah_tanggunganyangdibayar']}</p>
                                             <p><strong>Jumlah Beras:</strong> {$row['bayar_beras']}</p>
                                             <p><strong>Jumlah Uang:</strong> {$row['bayar_uang']}</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>";

                        echo "<div class='modal fade' id='editModal{$row['id_zakat']}' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                             <div class='modal-dialog'>
                                 <div class='modal-content'>
                                     <div class='modal-header'>
                                         <h5 class='modal-title' id='editModalLabel'>Edit Zakat</h5>
                                         <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                     </div>
                                     <div class='modal-body'>
                                         <form action='bayarzakat_editprocess.php' method='post'>
                                             <!-- Tambahkan input untuk data yang akan diedit -->
                                             <input type='hidden' name='id' value='{$row['id_zakat']}'>
                                             <label for='edit_nama_kk'>Nama KK:</label>
                                             <input type='text' name='edit_nama_kk' value='{$row['nama_kk']}' placeholder='Masukkan nama muzakki' id='edit_nama_kk' required>
                         
                                             <label for='edit_jumlah_tanggungan'>Jumlah Tanggungan:</label>
                                             <input type='number' name='edit_jumlah_tanggungan' value='{$row['jumlah_tanggungan']}' placeholder='Masukkan jumlah tanggungan' id='edit_jumlah_tanggungan' required>
                         
                                             <label for='edit_jumlah_tanggunganyangdibayar'>Jumlah Tanggungan yang dibayar</label>
                                             <input type='number' name='edit_jumlah_tanggunganyangdibayar' value='{$row['jumlah_tanggunganyangdibayar']}' placeholder='Masukkan jumlah tanggungan yang dibayar' id='edit_jumlah_tanggunganyangdibayar' required>
                         
                                             <div class='form-group'>
                                                 <label for='edit_jenis_bayar'>Jenis Bayar</label>
                                                 <br>
                                                 <select name='edit_jenis_bayar' value='{$row['jenis_bayar']}' onchange='updateJenisBayarEdit(this)'>
                                                     <option>Pilih</option>
                                                     <option value='beras'>Beras</option>
                                                     <option value='uang'>Uang</option>
                                                 </select>
                                             </div>
                         
                                             <div id='edit_beras' style='display: none'>
                                                 <label for='edit_beras'>Beras</label>
                                                 <br>
                                                 <input type='number' name='edit_beras' placeholder='Masukkan jumlah beras' id='edit_beras'>
                                             </div>
                         
                                             <div id='edit_uang' style='display: none'>
                                                 <label for='edit_uang'>Uang</label>
                                                 <br>
                                                 <input type='number' name='edit_uang' placeholder='Masukkan jumlah uang' id='edit_uang'>
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
            window.location.href = 'bayarzakat_deleteprocess.php?id=' + id;
        }
    }

    function updateJenisBayarEdit(el) {
        const editBerasInput = document.getElementById('edit_beras');
        const editUangInput = document.getElementById('edit_uang');

        if (el.value === 'beras') {
            editBerasInput.style.display = 'block';
            editUangInput.style.display = 'none';
            editUangInput.value = null;
        } else if (el.value === 'uang') {
            editBerasInput.style.display = 'none';
            editBerasInput.value = null;
            editUangInput.style.display = 'block';
        } else {
            editBerasInput.style.display = 'none';
            editUangInput.style.display = 'none';
        }
    }
</script>

</html>