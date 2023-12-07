<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Terminate script execution after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Data Pengumpulan Zakat | Sistem Informasi Zakat</title>
</head>

<body>

    <?php
    require "security/config.php";

    $query = "SELECT * FROM bayarzakat";
    $result = $conn->query($query);
    ?>

    <div class="table-container">
        <h2>Data Pengumpulan Zakat FItrah</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama KK</th>
                    <th>Jumlah Tanggungan</th>
                    <th>Jenis Bayar</th>
                    <th>Jumlah Tanggungan Yang Dibayar</th>
                    <th>Beras</th>
                    <th>Uang</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['id_zakat']}</td>
                                    <td>{$row['nama_kk']}</td>
                                    <td>{$row['jumlah_tanggungan']}</td>
                                    <td>{$row['jenis_bayar']}</td>
                                    <td>{$row['jumlah_tanggunganyangdibayar']}</td>
                                    <td>{$row['bayar_beras']}</td>
                                    <td>{$row['bayar_uang']}</td>
                                 </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data yang membayar zakat.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</body>
<script>window.print()</script>
</html>