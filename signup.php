<?php
include_once 'db_user.php';

include_once 'userManager.php';

use MyProject\User\UserManager;

$userManager = new UserManager($pdoUser); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($errors)) {
        $userManager->registerUser($username, $password);
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
         <button><a href="signup.php">SIGN UP</a></button>
         <button><a href="login.php">LOG IN</a></button>
      </div>   
      
     </div>

   </div>

   <div class="zalozenie">
      <h2>REGISTRÁCIA</h2>
      <div class="logo">
         <img class="main" src="img/putiklogo.png" alt="">
      </div>
      <div class="udaje">
      <form method="post" action="">
         <p>Email:</p>
         <input type="text" name="username"><br>
         <p>Heslo:</p>
         <input type="password" name="password"><br>
         <input class="signin" type="submit" value="Zaregistrovať sa">
      </form>
      <?php
    if (!empty($errors)) {
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


