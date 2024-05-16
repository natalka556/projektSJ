<?php

session_start();
$loggedIn = isset($_SESSION['user_id']);

include_once 'db_user.php';

include_once 'userManager.php';

use MyProject\User\UserManager;

$userManager = new UserManager($pdoUser);

$username = $password = '';
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($errors)) {
        $stmt = $pdoUser->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            
            header("Location: ttm.php");
            exit();
        } else {
            $errors[] = "Invalid username or password";
        }
    }
}
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

   <div id="menu">
      <div class="icons">
         <a href="index.php">
            <div class="layer">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <span class="fab fa-facebook-f"></span>
            </div>
            <div class="text">
               Home
            </div>
         </a>
         <a href="#">
            <div class="layer">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <span class="fab fa-twitter"></span>
            </div>
            <div class="text">
               Movies
            </div>
         </a>
         <a href="#">
            <div class="layer">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <span class="fab fa-instagram"></span>
            </div>
            <div class="text">
               TV Shows
            </div>
         </a>
         <a href="showtime.html">
            <div class="layer">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <span class="fab fa-linkedin-in"></span>
            </div>
            <div class="text">
               Show Times
            </div>
         </a>
         <a href="#">
            <div class="layer">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
               <span class="fab fa-youtube"></span>
            </div>
            <div class="text">
               Watch List
            </div>
         </a>
     </div>
 
     
 
     <div class="hladanie">

      <div class="bord">
         <input id="searchbar" onkeyup="search_movie()" type="text"
         name="search" placeholder="Vyhľadaj film alebo seriál...">
 
 
       <div class="searching">
          <a id="list" href="#">
             <div>
                <a class="names" href="ttm.php">Talk to me</a>
             </div>
             <p class="names">Cobweb</p>
             <p class="names">In time</p>
             <p class="names">Oppenheimer</p>
             <p class="names">Zootopia</p>
             <p class="names">Red Notice</p>
             <p class="names">Adrift</p>
             <p class="names">The visit</p>
             <p class="names">The nun</p>
             <p class="names">Abandoned</p>
             <p class="names">Tangled</p>
             <p class="names">Frozen</p>
          </a>
       </div> 
      </div>

       
     </div> 

     <div class="ucet">   
      <div class="ucdi">
         <?php if(!$loggedIn): ?>
            <button><a href="signup.php">SIGN UP</a></button>
            <button><a href="login.php">LOG IN</a></button>
         <?php endif; ?>
         <?php if($loggedIn): ?>
            <button><a href="logout.php">LOG OUT</a></button>
         <?php endif; ?>
      </div>   
      
     </div>

   </div>

   <div class="zalozenie">
      <h2>PRIHLÁSENIE</h2>
      <div class="logo">
         <img class="main" src="img/putiklogo.png" alt="">
      </div>
      <div class="udaje">
      <form method="post" action="login.php">
      <p>Email:</p>
         <input class="inp" type="text" id="email" name="username" value="<?php echo htmlspecialchars($username); ?>">
         <p>Heslo:</p>
         <input class="inp" type="password" name="password">
        <input class="signin" type="submit" value="Prihlásiť sa">
        <?php
        if (!empty($errors)) {
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
