<?php
// Spustí reláciu (session) alebo pokračuje v existujúcej relácii
// Relácia umožňuje uchovávať informácie naprieč rôznymi stránkami (napr. prihlasovacie údaje)
session_start();

// Skontroluje, či je nastavená hodnota user_id v relácii $_SESSION (t.j. či je používateľ prihlásený)
$loggedIn = isset($_SESSION['user_id']);

// vloží obsah súboru db_user.php a userManager.php do aktuálneho skriptu, ak tieto súbory ešte neboli vložené
include_once 'db_user.php';
include_once 'userManager.php';

// Používa PHP namespace MyProject\User a triedu UserManager z tejto oblasť názvov
// Toto umožňuje jednoduché používanie tejto triedy bez potreby plne kvalifikovaného názvu
use MyProject\User\UserManager;

// Vytvorí nový objekt UserManager s názvom $userManager, pričom ako parameter pre konštruktor odovzdá $pdoUser, čo je PDO objekt na pripojenie k databáze používateľov
$userManager = new UserManager($pdoUser);

// Inicializuje premenné $email a $password ako prázdne reťazce
$email = $password = '';
// Inicializuje premennú $errors ako prázdne pole, ktoré bude obsahovať chyby, ak nejaké nastanú
$errors = array();

// Skontroluje, či je požiadavka HTTP typu POST (či bol formulár odoslaný)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Priradí hodnoty email a password z poľa $_POST do premenných $email a $password
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Skontroluje, či pole $errors je prázdne
    // Ak je prázdne, znamená to, že zatiaľ neboli zistené žiadne chyby.
    if (empty($errors)) {
         // Pripraví SQL dotaz na získanie používateľa z tabuľky users, kde sa email rovná hodnote premennej $email
        $stmt = $pdoUser->prepare("SELECT * FROM users WHERE email = ?");
        
        // Priradí hodnotu $email k prvému parametru v pripravenom SQL dotaze
        $stmt->bindParam(1, $email);
        
        // Vykoná pripravený SQL dotaz
        $stmt->execute();

        // Získa výsledok dotazu a uloží ho do premennej $user ako asociatívne pole
        $user = $stmt->fetch();

        // Skontroluje, či bol používateľ nájdený ($user nie je false) a či sa heslo zhoduje s hashovaným heslom v databáze pomocou funkcie password_verify
        if ($user && password_verify($password, $user['password'])) {
            // Ak je heslo správne, uloží ID používateľa do relácie $_SESSION pod kľúčom user_id
            $_SESSION['user_id'] = $user['id'];
            // Uloží aj status administrátora (pravdepodobne boolean) do relácie $_SESSION pod kľúčom is_admin
            $_SESSION['is_admin'] = $user['is_admin'];

            // Presmeruje používateľa na stránku index.php
            header("Location: index.php");
            // Ukončí vykonávanie skriptu
            exit();
        } else {
         // Ak sa používateľ nenašiel alebo heslo nebolo správne, pridá chybu "Invalid email or password" do poľa $errors
            $errors[] = "Invalid email or password";
        }
    }
}

// vloží obsah súboru header.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený. 
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
      <h2>PRIHLÁSENIE</h2>
      <div class="logo">
         <img class="main" src="img/putiklogo.png" alt="">
      </div>
      <div class="udaje">
         <!-- Vytvára formulár, ktorý odošle dáta na stránku login.php pomocou metódy POST -->
         <form method="post" action="login.php">
            <p>Email:</p>
            <!-- nastavuje predvolenú hodnotu tohto vstupného poľa
            // PHP kód sa vykoná na serveri a vloží hodnotu premennej $email do poľa -->
            <input class="inp" type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"> 
            <p>Heslo:</p>
            <input class="inp" type="password" name="password">
            <input class="signin" type="submit" value="Prihlásiť sa">
            <?php
            // Kontroluje, či pole $errors nie je prázdne
            if (!empty($errors)) {
               // implode('<br>', $errors) spojí všetky prvky poľa $errors do jedného reťazca
                echo '<div style="color: red;">' . implode('<br>', $errors) . '</div>';
            }
            ?>
         </form>
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
