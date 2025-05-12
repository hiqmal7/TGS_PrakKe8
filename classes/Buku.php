<?php
class Buku {
    private $conn;
    private $table_name = "buku";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function tampilkanSemua() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
