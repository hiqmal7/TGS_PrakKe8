<?php

class Buku {
    private $conn;
    private $table_name = "buku";

    // Properti untuk data buku
    public $id;
    public $judul;
    public $penulis;
    public $tahun_terbit;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Membaca semua buku
    public function tampilkanSemua() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Membuat buku baru
    public function tambahBuku() {
        $query = "INSERT INTO " . $this->table_name . " SET judul=:judul, penulis=:penulis, tahun_terbit=:tahun_terbit";
        $stmt = $this->conn->prepare($query);

        // Sanitize data (membersihkan data dari karakter berbahaya)
        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
        $this->tahun_terbit = htmlspecialchars(strip_tags($this->tahun_terbit));

        // Mengikat nilai ke parameter query
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":tahun_terbit", $this->tahun_terbit);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Membaca satu buku berdasarkan ID
    public function tampilkanSatuBuku() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Mengatur properti objek dengan data yang ditemukan
        $this->judul = $row['judul'];
        $this->penulis = $row['penulis'];
        $this->tahun_terbit = $row['tahun_terbit'];
    }

    // Memperbarui buku yang sudah ada
    public function updateBuku() {
        $query = "UPDATE " . $this->table_name . " SET judul=:judul, penulis=:penulis, tahun_terbit=:tahun_terbit WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->judul = htmlspecialchars(strip_tags($this->judul));
        $this->penulis = htmlspecialchars(strip_tags($this->penulis));
        $this->tahun_terbit = htmlspecialchars(strip_tags($this->tahun_terbit));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Mengikat nilai ke parameter query
        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":penulis", $this->penulis);
        $stmt->bindParam(":tahun_terbit", $this->tahun_terbit);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Menghapus buku
    public function hapusBuku() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitize ID
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Mengikat ID
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}