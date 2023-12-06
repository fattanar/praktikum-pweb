<?php
include "security/config.php";

function clean_input($data)
{
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_nama']) && isset($_POST['edit_kategori'])) {
    $id_mustahiklainnya = clean_input($_POST['id']);
    $nama = clean_input($_POST['edit_nama']);
    $kategori = clean_input($_POST['edit_kategori']);
    $hak = ($kategori === 'amilin' || $kategori === 'fisabilillah' || $kategori === 'mualaf' || $kategori === 'ibnu_sabil') ? clean_input($_POST['edit_jumlah_hak']) : 0;

    // Periksa apakah ID adalah angka
    if (!is_numeric($id_mustahiklainnya)) {
        die("Invalid ID");
    }

    // Perbaiki penulisan variabel pada query UPDATE
    $query = "UPDATE mustahik_lainnya SET nama='$nama', kategori='$kategori', hak=$hak WHERE id_mustahiklainnya=$id_mustahiklainnya";

    // Cek query dan jalankan
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil diupdate.'); window.location.href = 'mustahik_lainnya.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

$conn->close();
?>
