<?php

class UserDatabase {
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

// Database connection settings for user authentication
$hostAuth = 'localhost'; // Change this if your database is hosted elsewhere
$dbnameAuth = 'user_authentication'; // Change this to your database name for authentication
$usernameAuth = 'root'; // Change this to your database username for authentication
$passwordAuth = ''; // Change this to your database password for authentication

// Create UserDatabase instance and connect
$userDb = new UserDatabase($hostAuth, $dbnameAuth, $usernameAuth, $passwordAuth);
$pdoUser = $userDb->connect();

?>