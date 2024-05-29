<?php

// Spustí reláciu (session) alebo pokračuje v existujúcej relácii
// Relácia umožňuje uchovávať informácie naprieč rôznymi stránkami (napr. prihlasovacie údaje)
session_start();

// Skontroluje, či je nastavená hodnota user_id v relácii $_SESSION (t.j. či je používateľ prihlásený)
$loggedIn = isset($_SESSION['user_id']);

// vloží obsah súboru header.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený
include_once 'header.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talk to me</title>
    <link rel="stylesheet" href="css/talktome.css">    
</head>
<body>
   

   <div class="uvod">
    
    <img src="img/talktome.jpg" alt="">

    <div class="uvodtext">
      <h3>Talk to me</h3>
    
      <div class="stars">
        <i><img class="sta" src="img/putiklogo.png" alt=""></i>
        <i><img class="sta" src="img/putiklogo.png" alt=""></i>
        <i><img class="sta" src="img/putiklogo.png" alt=""></i>
        <i><img class="sta" src="img/putiklogo.png" alt=""></i>
        <i><img class="sta" src="img/putiklogo.png" alt=""></i>
      </div>

      <div class="ofilme">
        <p>Réžia: Danny Philippou, Michael Philippou <br>
         Autori: Danny Philippou, Bill Hinzman, Daley Pearson <br> 
         Hviezdy: Ari McCarthy, Hamish Phillips, Kit Erhart-Bruce</p>        
      </div>
    </div>  
    
   </div>

   <div class="obsah">Obsah:
    <p>Keď skupina priateľov zistí, ako vykúzliť duchov
      pomocou nabalzamovanej ruky sa stanú závislými na novom vzrušení,
      kým jeden z nich nezajde príliš ďaleko a neotvorí dvere duchu
       svet, ktorý ich núti vybrať si, komu budú dôverovať: mŕtvym alebo živým.</p>
   </div>

   <div class="komenty">
    <?php if($loggedIn): ?>
    <form action="submitComments.php" method="post">
        <label for="name">Your Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="comment">Your Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Submit">
    </form>
    <hr>
    <?php endif; ?>
    
    <h2>Comments:</h2>
    <p>POTREBUJETE SA PRIHLASIT NA TO ABY STE MOHLI PRIDAT KOMENTAR</p><br>
    
    <?php

    // Vloží obsah súboru db_connection.php do aktuálneho skriptu
    include 'db_connection.php';

    // Vytvorí novú inštanciu triedy Database s pripojovacími údajmi 
    $db = new Database($host, $dbname, $username, $password);
    // zavolá metódu connect(), ktorá vytvorí spojenie s databázou a vráti PDO objekt.
    $pdo = $db->connect();


    // Priradí hodnotu ID prihláseného používateľa do premennej $loggedInUserId
    // Ak používateľ nie je prihlásený, táto premenná bude mať hodnotu null
    $loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


    // Vykoná SQL dopyt na získanie všetkých komentárov z databázy a usporiadá ich podľa dátumu vytvorenia zostupne
    // Výsledok je uložený v poli $comments.
    try {
        $stmt = $pdo->query("SELECT * FROM comments ORDER BY created_at DESC");
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    // prechádza každým komentárom v poli $comments.
    foreach ($comments as $comment) {
        // Vytvorí začiatok divu s triedou comment, ktorý bude obsahovať jednotlivé komentáre
        echo "<div class='comment'>";
        // Vypíše meno autora komentára, samotný komentár a dátum vytvorenia komentára
        echo "<p><strong>{$comment['name']}:</strong> {$comment['comment']} ({$comment['created_at']})</p>";
        // Tento riadok kontroluje, či je používateľ prihlásený a či je ID používateľa rovnaké ako ID prihláseného používateľa
        // Ak áno, používateľ má oprávnenie mazať a upravovať svoje vlastné komentáre
        if ($loggedIn && $comment['user_id'] == $loggedInUserId) {
            // Vytvorí formulár pre odstránenie komentára
            echo "<form method='post' action='deleteComment.php'>";
            echo "<input type='hidden' name='comment_id' value='{$comment['id']}'>"; 
            echo "<input type='submit' value='Delete'>"; 
            echo "</form>";
           
            // Vytvorí formulár pre úpravu komentára
            echo "<form method='get' action='editComment.php'>";
            echo "<input type='hidden' name='comment_id' value='{$comment['id']}'>"; 
            echo "<input type='submit' value='Edit'>"; 
            echo "</form>";
        }
        echo "</div>";
    }
    ?>
   </div>

   <script src="js/app.js"></script>
   <script src="js/rating.js"></script>
</body>
</html>
