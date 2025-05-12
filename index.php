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
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['penulis']; ?></td>
                <td><?= $row['tahun_terbit']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
