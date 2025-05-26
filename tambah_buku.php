<?php
require_once "config/Database.php";
require_once "classes/Buku.php";

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

if ($_POST) { // Jika ada data yang dikirim melalui POST
    $buku->judul = $_POST['judul'];
    $buku->penulis = $_POST['penulis'];
    $buku->tahun_terbit = $_POST['tahun_terbit'];

    if ($buku->tambahBuku()) {
        echo "<p>Buku berhasil ditambahkan!</p>";
    } else {
        echo "<p>Gagal menambahkan buku.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Tambah Buku Baru</h2>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="judul">Judul:</label><br>
        <input type="text" id="judul" name="judul" required><br><br>

        <label for="penulis">Penulis:</label><br>
        <input type="text" id="penulis" name="penulis" required><br><br>

        <label for="tahun_terbit">Tahun Terbit:</label><br>
        <input type="number" id="tahun_terbit" name="tahun_terbit" required><br><br>

        <input type="submit" value="Tambah Buku">
    </form>
    <p><a href="index.php">Kembali ke Daftar Buku</a></p>
</body>
</html>