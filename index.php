<?php
include 'security/config.php';
session_start();

if(isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256

    $sql = "SELECT * FROM users WHERE (username='$username' OR email = '$username') AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: landing.php");
        exit();
    } else {
        echo "<script>alert('Username atau password Anda salah. Silakan coba lagi!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login | Sistem Informasi Zakat</title>
</head>

<body>

    <div class="form-container">
        <form action="" method="POST">
            <h2>Login untuk mengakses data</h2>
            <input type="username" placeholder="Username or Email" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <button name="submit" class="btn">Login</button>
        </form>
    </div>

</body>

</html>