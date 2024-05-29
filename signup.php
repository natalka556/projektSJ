<?php

// vloží obsah súboru db_user.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený
include_once 'db_user.php';
// vloží obsah súboru userManager.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený
include_once 'userManager.php';


// Definuje alias pre triedu UserManager, ktorá sa nachádza v mennom priestore MyProject\User, aby sme ju mohli ľahšie používať v kóde
use MyProject\User\UserManager;

// Spustí reláciu (session) alebo pokračuje v existujúcej relácii
// Relácia umožňuje uchovávať informácie naprieč rôznymi stránkami (napr. prihlasovacie údaje)
session_start();

// Vytvorí novú inštanciu triedy UserManager a odovzdá jej pripojenie k databáze $pdoUser ako parameter
$userManager = new UserManager($pdoUser);

// Inicializuje prázdne pole $errors, ktoré bude slúžiť na ukladanie chýb
$errors = array();

// Kontroluje, či bol formulár odoslaný pomocou metódy POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Priradí hodnoty z formulára (POST) do lokálnych premenných 
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $is_admin = false; // Default is not admin

    // Skontroluje, či je aktuálny používateľ administrátor
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] && isset($_POST['is_admin']) && $_POST['is_admin'] == '1') {
      // 
        $is_admin = true;
    }

    // Overuje, či je emailová adresa zadaná
    if (empty($email)) {
      // Ak emailová adresa nie je zadaná pridá do poľa $errors chybu
        $errors[] = "Email is required";

        // Ak je emailová adresa zadaná ale nie je v správnom formáte (!filter_var($email, FILTER_VALIDATE_EMAIL))
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // pridá do poľa $errors chybu
        $errors[] = "Invalid email format";
    }

    // Ak pole $errors je prázdne 
    if (empty($errors)) {
      // zavolá metódu registerUser triedy UserManager a odovzdá jej hodnoty
        $userManager->registerUser($username, $password, $email, $is_admin); // Pass is_admin to registerUser
    }
}

// vloží obsah súboru header.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený
include_once 'header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/sign.css">
   <title>Sign in</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>


   <div class="zalozenie">
      <h2>REGISTRÁCIA</h2>
      <div class="logo">
         <img class="main" src="img/putiklogo.png" alt="">
      </div>
      <div class="udaje">
      <form method="post" action="">
            <p>Username:</p>
            <input type="text" name="username"><br>
            <p>Email:</p>
            <input type="email" name="email"><br>
            <p>Heslo:</p>
            <input type="password" name="password"><br>

            <!-- Kontroluje, či premenná $_SESSION['is_admin'] existuje a má hodnotu true -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <p>Admin:</p>
                <input type="checkbox" name="is_admin" value="1"><br>

                <!-- Tento riadok označuje koniec podmieneného bloku -->
            <?php endif; ?>
            <input class="signin" type="submit" value="Zaregistrovať sa">
         </form>
         <?php
         // Kontroluje, či pole $errors nie je prázdne
         if (!empty($errors)) {
            // Začína iteráciu cez každú položku v poli $errors
            // Premenná $error bude postupne obsahovať každú chybu v poli
             foreach ($errors as $error) {
                 echo "<p style='color: red;'>$error</p>";
             }
         }
         ?>
         
      </div>
      

      

   </div>

   <div class="doplnok">
      <a href="#">Zabudnuté heslo?</a>
      <a href="#">Nemáte účet? Zaregistrujte sa teraz!</a>
   </div>

   <div class="or">
      <p>alebo</p>
      <div class="gmial">
         <img class="image" src="img/gmailIcon.png" alt="">
         <a class="nazov" href="https://www.gmail.com/">Prihláste sa cez Gmail</a>
      </div>
      <div class="facebook">
         <img class="image" src="img/fbIcon.png" alt="">
         <a class="nazov" href="https://www.facebook.com/">Prihláste sa cez Facebook</a>
      </div>
      <div class="twitter">
         <img class="image" src="img/twitterIcon.png" alt="">
         <a class="nazov" href="https://www.twitter.com/">Prihláste sa cez Twitter</a>
      </div>
   </div>

   <script src="js/app.js"></script>
</body>
</html>

<?php

// vloží obsah súboru footer.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený
// Ak bol súbor už vložený, tento riadok bude ignorovaný.
 include_once 'footer.php';
?>


