<?php

class CommentForm {

    //Deklarácia privátnej premennej $pdo, ktorá bude obsahovať pripojenie k databáze
    private $pdo;


    //prijíma pripojenie k databáze ako parameter a nastavuje ho do premennej $pdo
    public function __construct($pdo) {
        // 
        $this->pdo = $pdo;
    }

    // spracúva odoslaný formulár s komentárom
    public function submitForm() {
        // Kontroluje, či bola požiadavka odoslaná pomocou metódy POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Priradí hodnoty z formulára (POST) do premenných
            $name = $_POST["name"];
            $comment = $_POST["comment"];

            // Kontroluje, či polia nie sú prázdne
            if (!empty($name) && !empty($comment)) {
                // Spustí reláciu (session) a získa ID prihláseného používateľa uloženého v relácii
                session_start();
                $userId = $_SESSION['user_id'];


                // Príprava a vykonanie SQL príkazu na vloženie nového komentára do databázy
                try {
                    $stmt = $this->pdo->prepare("INSERT INTO comments (name, comment, user_id) VALUES (?, ?, ?)");
                    $stmt->execute([$name, $comment, $userId]);

                    // Presmerovanie na inú stránku po úspešnom odoslaní komentára.
                    header("Location: ttm.php");
                    exit();

                    // Zachytenie a výpis prípadných chýb pri vkladaní komentára do databázy
                } catch (PDOException $e) {
                    die("Error: " . $e->getMessage());
                }

            } else {
                echo "Please fill in all fields.";
            }
        }
    }


    // maže komentár z databázy na základe jeho ID
    public function deleteComment($commentId) {
        // Príprava a vykonanie SQL príkazu na odstránenie komentára z databázy
        try {
            $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = ?");
            $stmt->execute([$commentId]);
            header("Location: ttm.php");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

// Vloží obsah súboru
include 'db_connection.php';

// Vytvorí novú inštanciu triedy CommentForm a odovzdá jej pripojenie k databáze $pdo
$commentForm = new CommentForm($pdo);


// Kontroluje, či bola požiadavka odoslaná pomocou metódy POST a či bola zaslaná akcia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Akcia delete bola zaslaná a bolo zadané ID komentára, zavolá sa metóda deleteComment() triedy CommentForm na odstránenie komentára z databázy
    if ($_POST['action'] == 'delete' && isset($_POST['comment_id'])) {
        $commentForm->deleteComment($_POST['comment_id']);
    }
}

// Zavolá metódu submitForm() triedy CommentForm na spracovanie odoslaného formulára s komentárom
$commentForm->submitForm();
?>
