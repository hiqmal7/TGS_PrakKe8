<?php
require_once "config/Database.php";
require_once "classes/Buku.php";

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

if (isset($_GET['id'])) { // Jika ID buku tersedia di URL
    $buku->id = $_GET['id'];
    $buku->tampilkanSatuBuku(); // Mengisi objek dengan data buku yang ada
}

if ($_POST) { // Jika ada data yang dikirim melalui POST (setelah form diedit)
    $buku->id = $_POST['id'];
    $buku->judul = $_POST['judul'];
    $buku->penulis = $_POST['penulis'];
    $buku->tahun_terbit = $_POST['tahun_terbit'];

    if ($buku->updateBuku()) {
        echo "<p>Buku berhasil diupdate!</p>";
    } else {
        echo "<p>Gagal mengupdate buku.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Edit Buku</h2>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id" value="<?= $buku->id; ?>">

        <label for="judul">Judul:</label><br>
        <input type="text" id="judul" name="judul" value="<?= $buku->judul; ?>" required><br><br>

        <label for="penulis">Penulis:</label><br>
        <input type="text" id="penulis" name="penulis" value="<?= $buku->penulis; ?>" required><br><br>

        <label for="tahun_terbit">Tahun Terbit:</label><br>
        <input type="number" id="tahun_terbit" name="tahun_terbit" value="<?= $buku->tahun_terbit; ?>" required><br><br>

        <input type="submit" value="Update Buku">
    </form>
    <p><a href="index.php">Kembali ke Daftar Buku</a></p>
</body>
</html>