<?php

// Spustíme reláciu (session) alebo pokračujeme v existujúcej relácii
// Relácia umožňuje uchovávať informácie naprieč rôznymi stránkami
session_start();

// Vložíme obsah súboru db_connection.php do aktuálneho skriptu
include 'db_connection.php';

// Vytvoríme nový objekt Database s názvom $db pomocou nastavení pripojenia 
$db = new Database($host, $dbname, $username, $password);
// Zavoláme metódu connect na objekte $db ktorá sa pripojí k databáze a vráti PDO objekt ktorý sa uloží do $pdo
$pdo = $db->connect();


// Skontrolujeme či je nastavená hodnota v poli $_POST s kľúčom comment_id (či bola odoslaná z formulára)
if(isset($_POST['comment_id'])) {
    // Ak je hodnota nastavená priradíme ju premennej $commentId
    $commentId = $_POST['comment_id'];

    // Pokúsime sa vykonať nasledujúci blok kódu a ak dôjde k chybe prejde do časti catch    
    try {
        // Pripraví SQL dotaz na vymazanie komentára z tabuľky comments, kde sa id rovná hodnote premennej $commentId.
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        // vykoná pripravený dotaz s hodnotou $commentId ako parametrom
        // Táto hodnota je bezpečne priradená do dotazu, aby sa predišlo SQL injekciám.
        $stmt->execute([$commentId]);
        
        // Po úspešnom vykonaní SQL dotazu presmeruje používateľa na stránku ttm.php
        header("Location: ttm.php");
        // ukončí vykonávanie skriptu, aby sa zabezpečilo, že žiadny ďalší kód nebude spustený po presmerovaní
        exit();

        // Ak nastane chyba počas prípravy alebo vykonania SQL dotazu, zachytí ju catch blok
    } catch (PDOException $e) {
        // vypíše chybovú správu a ukončí vykonávanie skriptu.
        die("Error: " . $e->getMessage());
    }

    
} else {
    // Ak nie je nastavená hodnota comment_id v poli $_POST, presmeruje používateľa na stránku ttm.php
    header("Location: ttm.php");
    //  ukončí vykonávanie skriptu
    exit();
}
?>
