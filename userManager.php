<?php

// Definuje namespace MyProject\User
namespace MyProject\User;

class UserManager {
    private $pdo;

    // prijíma pripojenie k databáze ako parameter a nastavuje ho do premennej $pdo.
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Začiatok definície metódy registerUser(), ktorá slúži na registráciu nového používateľa
    public function registerUser($username, $password, $email, $is_admin = false) {
        // obsahuje kód, ktorý sa má vykonať a môže spôsobiť výnimku
        try {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Príprava a vykonanie SQL príkazu na vloženie nového používateľa do databázy
            // Používa sa pripravený príkaz na bezpečné vloženie údajov.
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password, $is_admin]);

            // presmeruje nas na login.php
            header("Location: login.php");
            // ukonci kod
            exit();
            // zachytáva výnimky typu PDOException, ktoré môžu byť vyvolané pri chybe v databázovom príkaze
        } catch (\PDOException $e) {
            // Ak nastane chyba, skript zastaví svoje vykonávanie a vypíše chybové hlásenie
            die("Error: " . $e->getMessage());
        }
    }
}

?>
