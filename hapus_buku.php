<?php
require_once "config/Database.php";
require_once "classes/Buku.php";

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

if (isset($_GET['id'])) { // Jika ID buku tersedia di URL
    $buku->id = $_GET['id'];

    if ($buku->hapusBuku()) {
        header("Location: index.php"); // Redirect kembali ke daftar buku
        exit();
    } else {
        echo "<p>Gagal menghapus buku.</p>";
    }
} else {
    echo "<p>ID buku tidak ditemukan.</p>";
}
?>