<?php
include "security/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM mustahik_warga WHERE id_mustahikwarga = $id";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'data_distribusiwarga.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

// Tutup koneksi
$conn->close();
?>