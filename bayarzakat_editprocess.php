<?php
include "security/config.php";

function clean_input($data)
{
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_nama_kk']) && isset($_POST['edit_jumlah_tanggungan']) && isset($_POST['edit_jumlah_tanggunganyangdibayar'])) {
    $id_zakat = clean_input($_POST['id']);
    $nama_kk = clean_input($_POST['edit_nama_kk']);
    $jumlah_tanggungan = clean_input($_POST['edit_jumlah_tanggungan']);
    $jumlah_tanggunganyangdibayar = clean_input($_POST['edit_jumlah_tanggunganyangdibayar']);
    $jenis_bayar = clean_input($_POST['edit_jenis_bayar']);
    $bayar_beras = ($jenis_bayar === 'beras') ? clean_input($_POST['edit_beras']) : 'null';
    $bayar_uang = ($jenis_bayar === 'uang') ? clean_input($_POST['edit_uang']) : 'null';

    // Periksa apakah ID adalah angka
    if (!is_numeric($id_zakat)) {
        die("Invalid ID");
    }

    $query = "UPDATE bayarzakat SET nama_kk='$nama_kk', jumlah_tanggungan='$jumlah_tanggungan', jumlah_tanggunganyangdibayar='$jumlah_tanggunganyangdibayar', jenis_bayar='$jenis_bayar', bayar_beras=$bayar_beras, bayar_uang=$bayar_uang WHERE id_zakat=$id_zakat";

    // Cek query dan jalankan
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data berhasil diupdate.'); window.location.href = 'data_bayarzakat.php'; </script>";
    } else {
        echo "<script>alert('Error: " . $query . "\\n" . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}

$conn->close();
?>
