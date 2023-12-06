<?php

include "security/config.php";

if (isset($_POST['submit'])) {
    //insert
    $nama_kk = $_POST['nama_kk'];
    $jumlah_tanggungan = $_POST['jumlah_tanggungan'];
    $jumlah_tanggunganyangdibayar = $_POST['jumlah_tanggunganyangdibayar'];
    $jenis_bayar = $_POST['jenis_bayar'];
    $beras = $_POST['beras'] ?: "null";
    $uang = $_POST['uang'] ?: "null";
    $query = "INSERT INTO bayarzakat (nama_kk, jumlah_tanggungan, jumlah_tanggunganyangdibayar, jenis_bayar, bayar_beras, bayar_uang) VALUES ('$nama_kk', '$jumlah_tanggungan', '$jumlah_tanggunganyangdibayar', '$jenis_bayar', $beras, $uang)";
    $insert = $conn->query($query);
    if ($insert) {
        echo "<script>alert('Data berhasil disimpan.');
        window.location.href = 'kategori_mustahik.php';
        </script>";
    } else {
        echo "<div class='message-top'>gagal</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Bayar Zakat | Sistem Informasi Zakat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include ('nav.php'); ?>

    <div class="form-container">
        <h2>Bayar Zakat</h2>
            <form action="#" method="post">

            <label for="nama_kk">Nama KK:</label>
            <input type="text" name="nama_kk" placeholder="Masukkan nama muzakki" id="nama_kk" required>

            <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
            <input type="number" name="jumlah_tanggungan" placeholder="Masukkan jumlah tanggungan" id="jumlah_tanggungan" required>

            <label for="jumlah_tanggunganyangdibayar">Jumlah Tanggungan yang dibayar</label>
            <input type="number" name="jumlah_tanggunganyangdibayar" placeholder="Masukkan jumlah tanggungan yang dibayar" id="jumlah_tanggunganyangdibayar" required>

        <div class="form-group">
            <label for="jenis_bayar">Jenis Bayar</label>
            <br>
            <select name="jenis_bayar" onchange="updateJenisBayar(this)">
                <option>Pilih</option>
                <option value="beras">Beras</option>
                <option value="uang">Uang</option>
            </select>
        </div>

        <div id="beras" style="display: none">
            <label for="beras">Beras</label>
            <br>
            <input type="number" name="beras" placeholder="Masukkan jumlah beras" id="beras">
        </div>

        <div id="uang" style="display: none">
            <label for="uang">Uang</label>
            <br>
            <input type="number" name="uang" placeholder="Masukkan jumlah uang" id="uang">
        </div>

            <button type="submit" name="submit">Kirim</button>
</div>
    </form>
<script>
    function updateJenisBayar(el) {
        if (el.value === 'beras') {
            document.getElementById('beras').style.display = 'block'
            document.getElementById('uang').style.display = 'none'
            document.getElementById('uang').value = null
        } else if (el.value === 'uang') {
            document.getElementById('beras').style.display = 'none'
            document.getElementById('beras').value = null
            document.getElementById('uang').style.display = 'block'
        } else {
            document.getElementById('beras').style.display = 'none'
            document.getElementById('uang').style.display = 'none'
        }
    }
</script>
</body>

</html>