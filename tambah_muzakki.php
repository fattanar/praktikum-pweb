<?php

session_start();

if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Terminate script execution after the redirect
}

require('security/config.php');

function clean_input($data) {
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($data)));
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = clean_input($_POST["nama"]);
    $tanggungan = clean_input($_POST["tanggungan"]);
    $keterangan = clean_input($_POST["keterangan"]);

    $query = "INSERT INTO muzakki (nama_muzakki, jumlah_tanggungan, keterangan) VALUES ('$nama', '$tanggungan', '$keterangan')";

    if($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil disimpan.');
        window.location.href = 'muzakki.php';
        </script>";
    } else {
        echo "<script>alert('Error: ".$query."\\n".$conn->error."');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Muzakki | Sistem Informasi Zakat</title>
</head>

<body>

    <?php require('nav.php'); ?>

    <div class="form-container">
        <h2>Tambah Muzakki</h2>
        <form action="#" method="post">
            <label for="nama">Nama Muzakki:</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama muzakki" required>

            <label for="tanggungan">Jumlah Tanggungan:</label>
            <input type="number" id="tanggungan" name="tanggungan" placeholder="Masukkan jumlah tanggungan" required>

            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" placeholder="Masukkan keterangan" required></textarea>

            <button type="submit">Kirim</button>
        </form>
    </div>

</body>

</html>