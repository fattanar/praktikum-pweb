<?php
include "security/config.php";

function clean_input($data)
{
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_nama']) && isset($_POST['edit_hak'])) {
    $id_kategori = clean_input($_POST['id_kategori']);
    $nama_kategori = clean_input($_POST['edit_nama']);
    $jumlah_hak = clean_input($_POST['edit_hak']);

    // Periksa apakah ID adalah angka
    if (!is_numeric($id_kategori)) {
        die("Invalid ID");
    }

    $query = "UPDATE kategori_mustahik SET nama_kategori='$nama_kategori', jumlah_hak='$jumlah_hak' WHERE id_kategori=$id_kategori";

    // Cek query dan jalankan
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil diupdate.'); window.location.href = 'kategori_mustahik.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

$conn->close();
?>
