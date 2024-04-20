<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talk to me</title>
    <link rel="stylesheet" href="css/talktome.css">    
</head>
<body>
    
   <div id="menu">
      <div class="icons">
         <a href="index.html">
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
                <a class="names" href="talktome.html">Talk to me</a>
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
         <button><a href="#">SIGN UP</a></button>
         <button><a href="sign.html">LOGIN</a></button>
      </div>   
      
     </div>

   </div>

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
   <form action="submitComment.php" method="post">
        <label for="name">Your Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="comment">Your Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Submit">
    </form>

    
    <hr>
    
    <h2>Comments:</h2>
    <?php
    include 'retrieveComments.php';
    ?>


   </div>

   <script src="js/app.js"></script>
   <script src="js/rating.js"></script>
</body>
</html>