<?php

namespace MyProject\User;

class UserManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerUser($username, $password, $email, $is_admin = false) {
        try {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password, $is_admin]);

            header("Location: login.php");
            exit();
        } catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

?>
