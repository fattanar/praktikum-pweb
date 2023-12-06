<?php
include "security/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM bayarzakat WHERE id_zakat = $id";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'muzakki.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

// Tutup koneksi
$conn->close();
?>