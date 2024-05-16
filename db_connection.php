<?php

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error: Could not connect. " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}

// Database connection settings
$host = 'localhost'; // Change this if your database is hosted elsewhere
$dbname = 'comments'; // Change this to your database name
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password

// Create a Database instance and connect
$db = new Database($host, $dbname, $username, $password);
$pdo = $db->connect();
?>
