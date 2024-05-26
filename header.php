<?php
session_start();

$loggedIn = isset($_SESSION['user_id']); 

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
         
            <?php if($loggedIn): ?>
               <button><a href="logout.php">LOG OUT</a></button>
               <button><a href="reviews.php">REVIEWS</a></button>
               <?php endif; ?>
            
               <?php if(!$loggedIn): ?>
               <button><a href="signup.php">SIGN UP</a></button>
               <button><a href="login.php">LOG IN</a></button>
            <?php endif; ?>
         </div>   
         
        </div>
   
      </div> 