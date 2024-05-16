<?php
session_start();

$loggedIn = isset($_SESSION['user_id']); // Kontrola, či je používateľ prihlásený

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Database</title>
    <link rel="stylesheet" href="css/style.css">    
</head>
<body>


   <div class="rr">
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
         <!-- Tlačítko pro přihlášeného uživatele -->
         <?php if($loggedIn): ?>
            <button><a href="logout.php">LOG OUT</a></button>
            <?php endif; ?>
            <!-- Tlačítko pro nepřihlášeného uživatele -->
            <?php if(!$loggedIn): ?>
            <button><a href="signup.php">SIGN UP</a></button>
            <button><a href="login.php">LOG IN</a></button>
            <?php endif; ?>
         </div>   
         
        </div>
   
      </div>     
   
   
      <div class="moviesDat">
           <a href="ttm.php">
               <div class="layer2">
                  <span class="namesDat"><img src="img/talktome.jpg" alt=""></span>
                  <p class="textDat">Talk to me</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/intime.jpg" alt=""></span>
                  <p class="textDat">In time</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/cobweb.jpg" alt=""></span>
                  <p class="textDat">Cobweb</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/oppenheimer.jpg" alt=""></span>
                  <p class="textDat">Oppenheimer</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/zootopia.jpg" alt=""></span>
                  <p class="textDat">Zootopia</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/rednotice.jpg" alt=""></span>
                  <p class="textDat">Red notice</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/adrift.jpg" alt=""></span>
                  <p class="textDat">Adrift</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/thevisit.jpg" alt=""></span>
                  <p class="textDat">The visit</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/nun.jpg" alt=""></span>
                  <p class="textDat">The nun</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/abandoned.jpg" alt=""></span>
                  <p class="textDat">Abandoned</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/tangled.jpg" alt=""></span>
                  <p class="textDat">Tangled</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/frozen.jpg" alt=""></span>
                  <p class="textDat">Frozen</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/brave.jpg" alt=""></span>
                  <p class="textDat">Brave</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/split.jpg" alt=""></span>
                  <p class="textDat">Split</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/cam.jpg" alt=""></span>
                  <p class="textDat">Cam</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/ouija.jpg" alt=""></span>
                  <p class="textDat">Ouija</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/upgrade.jpg" alt=""></span>
                  <p class="textDat">Upgrade</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/barbie.jpg" alt=""></span>
                  <p class="textDat">Barbie</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/goldencompass.jpg" alt=""></span>
                  <p class="textDat">The golden compass</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/suicidesquad.jpg" alt=""></span>
                  <p class="textDat">Suicide squad</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/maleficent.jpg" alt=""></span>
                  <p class="textDat">Maleficent</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/krampus.jpg" alt=""></span>
                  <p class="textDat">Krampus</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/readyplayerone.jpg" alt=""></span>
                  <p class="textDat">Ready player one</p>
               </div>
            </a>
            <a href="#">
               <div class="layer2">
                  <span class="namesDat"><img src="img/valerian.jpg" alt=""></span>
                  <p class="textDat">Valerian and the City of a Thousand Planets</p>
               </div>
            </a>
       </div>
   </div>
    
   


    
    

    <script src="js/app.js"></script>
</body>
</html>