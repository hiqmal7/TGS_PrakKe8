<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Selamat Datang, <?= $_SESSION['username']; ?>!</h2>
    <p>Ini adalah halaman untuk pengguna biasa.</p>
    <ul>
        <li><a href="index.php">Lihat Daftar Buku</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>