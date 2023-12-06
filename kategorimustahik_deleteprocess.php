<?php
include "security/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM kategori_mustahik WHERE id_kategori = $id";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'kategori_mustahik.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

// Tutup koneksi
$conn->close();
?>