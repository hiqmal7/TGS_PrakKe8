<?php

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $level;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Metode login
    public function login() {
        $query = "SELECT id, username, password, level FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username)); // Sanitize input
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->level = $row['level'];
            $hashed_password = $row['password'];

            // Verifikasi kata sandi
            if (password_verify($this->password, $hashed_password)) {
                return true;
            }
        }
        return false;
    }
}