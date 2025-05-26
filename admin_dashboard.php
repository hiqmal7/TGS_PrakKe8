<?php
session_start();

// Periksa apakah pengguna sudah login dan adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 0) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Selamat Datang, Admin <?= $_SESSION['username']; ?>!</h2>
    <p>Ini adalah halaman khusus administrator.</p>
    <ul>
        <li><a href="index.php">Manajemen Buku (CRUD)</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>