<?php

// Spustí reláciu (session) alebo pokračuje v existujúcej relácii
// Relácia umožňuje uchovávať informácie naprieč rôznymi stránkami (napr. prihlasovacie údaje)
session_start();


// Skontroluje, či je nastavená hodnota user_id v relácii $_SESSION (či je používateľ prihlásený)
if (!isset($_SESSION['user_id'])) {
    // Ak nie je user_id nastavené, presmeruje používateľa na prihlasovaciu stránku login.php 
    header("Location: login.php");
    // ukončíme vykonávanie skriptu
    exit();
}

// Vloží obsah súboru db_connection.php do aktuálneho skriptu
include 'db_connection.php';

// Vytvorí nový objekt Database s názvom $db pomocou nastavení pripojenia
$db = new Database($host, $dbname, $username, $password);
// Zavolá metódu connect ktorá sa pripojí k databáze a vráti PDO objekt, ktorý sa uloží do $pdo
$pdo = $db->connect();


// Skontroluje, či je požiadavka HTTP typu POST (či bol formulár odoslaný)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ak áno, priradí hodnotu comment_id z poľa $_POST do premennej $comment_id    
    $comment_id = $_POST['comment_id'];
    // a hodnotu comment z poľa $_POST do premennej $new_comment
    $new_comment = $_POST['comment'];

    // Pokúsi sa vykonať nasledujúci blok kódu, a ak dôjde k chybe, prejde do časti catch
    try {
        // Pripraví SQL dotaz na získanie komentára z tabuľky comments, kde sa id rovná hodnote premennej $comment_id
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
        // Vykoná pripravený dotaz s hodnotou $comment_id ako parametrom
        $stmt->execute([$comment_id]);
        // Uloží výsledok dotazu do premennej $comment vo forme asociatívneho poľa
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);

        // Skontroluje, či komentár neexistuje alebo či používateľské ID komentára sa nezhoduje s používateľským ID v relácii $_SESSION
        if (!$comment || $comment['user_id'] != $_SESSION['user_id']) {
            // ukončí vykonávanie skriptu a vypíše "Unauthorized action"
            die("Unauthorized action");
        }

        // Pripraví SQL dotaz na aktualizáciu komentára v tabuľke comments, kde sa id rovná hodnote premennej $comment_id a nastaví nový text komentára na hodnotu $new_comment
        $update_stmt = $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        // Vykoná pripravený dotaz s hodnotami $new_comment a $comment_id ako parametrami.
        $update_stmt->execute([$new_comment, $comment_id]);

        //  presmeruje používateľa na stránku ttm.php.
        header("Location: ttm.php");
        // ukončí vykonávanie skriptu
        exit();

        // Ak nastane chyba počas prípravy alebo vykonania SQL dotazu, zachytí ju catch blok
    } catch (PDOException $e) {
        // vypíše chybovú správu a ukončí vykonávanie skriptu
        die("Error: " . $e->getMessage());
    }
    
} else {
    // Ak požiadavka HTTP nie je typu POST priradí hodnotu comment_id z poľa $_GET do premennej $comment_id
    $comment_id = $_GET['comment_id'];

    // Pokúsi sa vykonať nasledujúci blok kódu, a ak dôjde k chybe, prejde do časti catch.
    try {
        // Pripraví SQL dotaz na získanie komentára z tabuľky comments, kde sa id rovná hodnote premennej $comment_id.
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
        // Vykoná pripravený dotaz s hodnotou $comment_id ako parametrom.
        $stmt->execute([$comment_id]);
        // Uloží výsledok dotazu do premennej $comment vo forme asociatívneho poľa.
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);

        // Skontroluje, či komentár neexistuje alebo či používateľské ID komentára sa nezhoduje s používateľským ID v relácii $_SESSION
        if (!$comment || $comment['user_id'] != $_SESSION['user_id']) {
            // Ak je jedna z týchto podmienok pravdivá, ukončí vykonávanie skriptu a vypíše "Unauthorized action"
            die("Unauthorized action");
        }
        // Ak nastane chyba počas prípravy alebo vykonania SQL dotazu
    } catch (PDOException $e) {
        // vypíše chybovú správu a ukončí vykonávanie skriptu.
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
</head>
<body>
    <h2>Edit Your Comment</h2>
    <!-- Vytvára formulár, ktorý odošle dáta na stránku editComment.php pomocou metódy POST -->
    <form action="editComment.php" method="post">
        <!-- Vytvára skryté pole s názvom comment_id, ktoré obsahuje ID komentára (escape-ované pomocou htmlspecialchars) -->
        <input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($comment['id']); ?>">
        <label for="comment">Comment:</label><br>
        <!-- Vytvára textovú oblasť na úpravu komentára, ktorá je naplnená aktuálnym textom komentára (escape-ovaným pomocou htmlspecialchars). -->
        <textarea id="comment" name="comment" rows="4" cols="50"><?php echo htmlspecialchars($comment['comment']); ?></textarea><br>
        <input type="submit" value="Update Comment">
    </form>
</body>
</html>
