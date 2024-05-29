<?php
// Spustí reláciu (session) alebo pokračuje v existujúcej relácii
// Relácia umožňuje uchovávať informácie naprieč rôznymi stránkami (napr. prihlasovacie údaje)
session_start();
// Kontroluje, či nie je nastavená hodnota user_id v relácii $_SESSION(či používateľ nie je prihlásený)
if (!isset($_SESSION['user_id'])) { 
    // presmeruje používateľa na stránku login.php
    header('Location: login.php');
    // Ukončí vykonávanie skriptu
    exit();
}

// Priradí hodnotu is_admin z relácie $_SESSION do lokálnej premennej $is_admin.
$is_admin = $_SESSION['is_admin']; // Assuming 'is_admin' is stored in the session

// Kontroluje, či hodnota $is_admin je false, čo znamená, že používateľ nie je administrátor.
if (!$is_admin) {
    // presmeruje používateľa na stránku index.php
    header('Location: index.php'); 
    // Ukončí vykonávanie skriptu
    exit();
}

// vloží obsah súboru db_connection.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený
include_once 'db_connection.php';

// Kontroluje, či premenna $pdo, ktorá obsahuje pripojenie k databáze, nie je definovaná alebo je neplatná
if (!$pdo) {
    // skript sa ukončí a vypíše chybovú správu
    die("Connection failed: Connection variable not defined");
}

// blok začína pokus o vykonanie kódu, ktorý môže spôsobiť výnimku.
try {
    // vykoná SQL dotaz a vráti PDOStatement objekt
    $stmt = $pdo->query("SELECT * FROM users");
    // načíta všetky riadky výsledku dotazu do poľa asociatívnych polí
    $users_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // zachytáva akúkoľvek PDO výnimku, ktorá môže nastať pri vykonávaní dotazu
} catch (PDOException $e) {
    // ukončí skript a vypíše chybovú správu
    die("Query failed: " . $e->getMessage());
}

// blok začína pokus o vykonanie kódu, ktorý môže spôsobiť výnimku.
try {
    // vykoná SQL dotaz s JOIN medzi tabuľkami comments a users a vráti PDOStatement objekt
    $stmt = $pdo->query("SELECT comments.id, comments.comment, comments.created_at, users.username 
                         FROM comments 
                         JOIN users ON comments.user_id = users.id");

    // načíta všetky riadky výsledku dotazu do poľa asociatívnych polí
    $comments_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // zachytáva akúkoľvek PDO výnimku, ktorá môže nastať pri vykonávaní dotazu
} catch (PDOException $e) {
    // ukončí skript a vypíše chybovú správu
    die("Query failed: " . $e->getMessage());
}

// vloží obsah súboru header.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený
include_once 'header.php';

?>

<!DOCTYPE html>
<html lang="en" style="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <h1 style="margin-top:15%; margin-left:15%; color:white;">Admin Interface</h1>
    
    <div class="table-container" style="display:flex" >
        <table id="comments-table" style="text-align:center; margin-left:15%; margin-top:5%; color:white;">
            <caption>Comments</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- cyklus iteruje cez každý prvok poľa $comments_result. -->
                <?php foreach($comments_result as $comment): ?>
                <tr>
                    <!-- zabezpečuje, že všetky špeciálne znaky sú prevedené na HTML entity, aby sa predišlo XSS útokom. -->
                    <td><?php echo htmlspecialchars($comment['id']); ?></td>
                    <!-- -->
                    <td><?php echo htmlspecialchars($comment['username']); ?></td>
                    <!-- -->
                    <td><?php echo htmlspecialchars($comment['comment']); ?></td>
                    <!-- -->
                    <td><?php echo htmlspecialchars($comment['created_at']); ?></td>
                    <!-- -->
                    <td>
                        <!-- zabezpečuje, že hodnota id je správne zakódovaná pre URL. -->
                        <a href="deleteComment.php?id=<?php echo htmlspecialchars($comment['id']); ?>">Delete</a>
                    </td>
                </tr>

                <!-- Ukončuje foreach cyklus -->
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <table id="users-table" style="text-align:center ;margin-left:20%; margin-top:5%; color:white;">
            <caption>Users</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users_result as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['is_admin']) ? 'Yes' : 'No'; ?></td>
                    <td>
                        <!--<a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>">Delete</a>-->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<!-- vloží obsah súboru footer.php do aktuálneho skriptu, ak tento súbor ešte nebol vložený -->
<!-- Ak bol súbor už vložený, tento riadok bude ignorovaný -->
<?php include 'footer.php'; ?>
