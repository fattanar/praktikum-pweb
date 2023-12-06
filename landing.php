<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Terminate script execution after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Zakat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require('nav.php'); ?>

    <center><h1>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h1></center>
</body>

</html>