<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, redirect ke halaman login.php
    header("Location: login.php");
    exit(); // Pastikan untuk keluar setelah melakukan redirect
}

// Opsional: Anda juga bisa memeriksa level di sini jika ingin membatasi fitur CRUD
// Contoh: Jika hanya admin yang boleh melakukan CRUD, tambahkan ini:
/*
if ($_SESSION['level'] != 0) { // Jika bukan admin
    echo "<p>Anda tidak memiliki izin untuk mengelola buku.</p>";
    // Atau bisa juga redirect ke user_dashboard.php
    // header("Location: user_dashboard.php");
    exit();
}
*/

require_once "config/Database.php";
require_once "classes/Buku.php";

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);
$stmt = $buku->tampilkanSemua();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Daftar Buku</h2>
    <p><a href="tambah_buku.php">Tambah Buku Baru</a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['penulis']; ?></td>
                <td><?= $row['tahun_terbit']; ?></td>
                <td>
                    <a href="edit_buku.php?id=<?= $row['id']; ?>">Edit</a> |
                    <a href="hapus_buku.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <p><a href="logout.php">Logout</a></p> </body>
</html>



<?php
require_once "config/Database.php";
require_once "classes/Buku.php";

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);
$stmt = $buku->tampilkanSemua();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Daftar Buku</h2>
    <p><a href="tambah_buku.php">Tambah Buku Baru</a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['penulis']; ?></td>
                <td><?= $row['tahun_terbit']; ?></td>
                <td>
                    <a href="edit_buku.php?id=<?= $row['id']; ?>">Edit</a> |
                    <a href="hapus_buku.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>