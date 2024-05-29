<?php


// definujeme triedu a definujeme parametre
class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;


    //Definuje konštruktor ktorý inicializuje vlastnosti triedy pri vytváraní nového objektu
    public function __construct($host, $dbname, $username, $password) {
        // nastavime hodnotu parametrov
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }


    // Definujeme metódu ktorou sa pripajame k databáze cez PDO
    public function connect() {
        // kontrolujeme ci existuje pripojenie k databaze
        if ($this->pdo === null) {
            // pokúsime sa vytvoriť nové PDO pripojenie a v prípade chyby zachytíme výnimku
            try {
                // vytvoríme nové PDO pripojenie s poskytnutými údajmi
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
                // Nastavuje pripojenie PDO aby v prípade chyby vyvolávalo výnimky
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // v prípade chyby vypíše chybovú správu a ukončí skript
            } catch (PDOException $e) {
                die("Error: Could not connect. " . $e->getMessage());
            }
        }
        // vrátime objekt PDO
        return $this->pdo;
    }
}

// Definujeme premenné s nastaveniami pripojenia k databáze
$host = 'localhost'; 
$dbname = 'movies'; 
$username = 'root';
$password = '';

// Vytvoríme nový objekt Database s názvom $db pomocou nastavení pripojenia
$db = new Database($host, $dbname, $username, $password);
// zavoláme metódu connect na objekte $db a pripojíme sa k databáze, pričom objekt PDO sa uloží do $pdo
$pdo = $db->connect();

?>
