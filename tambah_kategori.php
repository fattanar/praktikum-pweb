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
    $jumlah = clean_input($_POST["jumlah"]);

    $query = "INSERT INTO kategori_mustahik (nama_kategori, jumlah_hak) VALUES ('$nama', '$jumlah')";

    if($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil disimpan.');
        window.location.href = 'kategori_mustahik.php';
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
    <title>Tambah Kategori Mustahik | Sistem Informasi Zakat</title>
</head>

<body>

    <?php require('nav.php'); ?>

    <div class="form-container border">
        <h2>Tambah Kategori Mustahik</h2>
        <form action="#" method="post">
            <label for="nama">Nama Kategori:</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama kategori" required>

            <label for="tanggungan">Jumlah Hak:</label>
            <input type="number" id="jumlah" name="jumlah" placeholder="Masukkan jumlah hak" required>

            <button type="submit">Kirim</button>
        </form>
    </div>

</body>

</html>