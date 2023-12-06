<?php

include "security/config.php";

if(isset($_POST['submit'])) {
    //insert
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $amilin = $_POST['amilin'] ?: "null";
    $fisabilillah = $_POST['fisabilillah'] ?: "null";
    $mualaf = $_POST['mualaf'] ?: "null";
    $ibnu_sabil = $_POST['ibnu_sabil'] ?: "null";
    $hak = $_POST['hak'] ?: "null";
    $query = "INSERT INTO mustahik_lainnya (nama, kategori, hak) VALUES ('$nama', '$kategori', '$hak')";
    $insert = $conn->query($query);
    if($insert) {
        echo "<script>alert('Data berhasil disimpan.');
        window.location.href = 'data_distribusilainnya.php';
        </script>";
    } else {
        echo "<div class='message-top'>gagal</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Mustahik Lainnya | Sistem Informasi Zakat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include('nav.php'); ?>

    <div class="form-container">
        <h2>Tambah Distribusi Warga</h2>
        <form action="#" method="post">

            <label for="nama">Nama:</label>
            <input type="text" name="nama" placeholder="Masukkan nama" id="nama" required>

            <div class="form-group">
                <label for="kategori">kategori</label>
                <br>
                <select name="kategori" onchange="updateKategori(this)">
                    <option>Pilih</option>
                    <option value="amilin">Amilin</option>
                    <option value="fisabilillah">Fisabilillah</option>
                    <option value="mualaf">Mualaf</option>
                    <option value="ibnu_sabil">Ibnu Sabil</option>
                </select>
            </div>

            <div id="hak" style="display: none">
                <label for="hak">Hak</label>
                <br>
                <input type="number" name="hak" placeholder="Masukkan jumlah hak" id="hak">
            </div>

            <button type="submit" name="submit">Kirim</button>
    </div>
    </form>
    <script>
        function updateKategori(el) {
            if (el.value === 'amilin') {
                document.getElementById('hak').style.display = 'block'
                document.getElementById('amilin').value = null
            } else if (el.value === 'fisabilillah') {
                document.getElementById('hak').style.display = 'block'
                document.getElementById('fisabilillah').value = null
            } else if (el.value === 'mualaf') {
                document.getElementById('mualaf').style.display = 'block'
                document.getElementById('hak').value = null
            } else if (el.value === 'ibnu_sabil') {
                document.getElementById('ibnu_sabil').style.display = 'block'
                document.getElementById('hak').value = null
            } else {
                document.getElementById('beras').style.display = 'none'
                document.getElementById('uang').style.display = 'none'
                document.getElementById('mampu').style.display = 'none'
            }
        }
    </script>
</body>

</html>