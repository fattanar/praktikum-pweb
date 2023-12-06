<?php
include "security/config.php";

function clean_input($data)
{
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_nama']) && isset($_POST['edit_tanggungan']) && isset($_POST['edit_keterangan'])) {
    $id_muzakki = clean_input($_POST['id_muzakki']);
    $nama_muzakki = clean_input($_POST['edit_nama']);
    $jumlah_tanggungan = clean_input($_POST['edit_tanggungan']);
    $keterangan = clean_input($_POST['edit_keterangan']);

    // Periksa apakah ID adalah angka
    if (!is_numeric($id_muzakki)) {
        die("Invalid ID");
    }

    $query = "UPDATE muzakki SET nama_muzakki='$nama_muzakki', jumlah_tanggungan='$jumlah_tanggungan', keterangan='$keterangan' WHERE id_muzakki=$id_muzakki";

    // Cek query dan jalankan
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil diupdate.'); window.location.href = 'muzakki.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

$conn->close();
?>
