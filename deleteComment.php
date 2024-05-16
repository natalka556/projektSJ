<?php
session_start();


include 'db_connection.php';

$db = new Database($host, $dbname, $username, $password);
$pdo = $db->connect();

if(isset($_POST['comment_id'])) {
    $commentId = $_POST['comment_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$commentId]);
        
        header("Location: ttm.php");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ttm.php");
    exit();
}
?>
