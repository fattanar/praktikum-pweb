<?php
include "security/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM mustahik_lainnya WHERE id_mustahiklainnya = $id";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'data_distribusilainnya.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

// Tutup koneksi
$conn->close();
?>