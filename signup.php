<?php
include_once 'db_user.php';
include_once 'userManager.php';

use MyProject\User\UserManager;

session_start();

$userManager = new UserManager($pdoUser);

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $is_admin = false; // Default is not admin

    // Check if the current user is an admin and wants to create an admin account
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] && isset($_POST['is_admin']) && $_POST['is_admin'] == '1') {
        $is_admin = true;
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($errors)) {
        $userManager->registerUser($username, $password, $email, $is_admin); // Pass is_admin to registerUser
    }
}

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
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                <p>Admin:</p>
                <input type="checkbox" name="is_admin" value="1"><br>
            <?php endif; ?>
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

<?php
 include_once 'footer.php';
?>


