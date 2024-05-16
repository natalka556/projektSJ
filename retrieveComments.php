<?php
//$comments = array(
    //array("Janka", "uzasny film!"),
    //array("Sara", "Určite odporúčam"),
    //array("Mišo", "Ten koniec nebol dobre spracovany")
//);

//foreach ($comments as $comment) {
    //echo "<p><strong>{$comment[0]}:</strong> {$comment[1]}</p>";
//}
?>

<!-- retrieve_comments.php -->

<?php
// Include database connection
//include 'db_connection.php';

//try {
    // Retrieve comments from the database
    //$stmt = $pdo->query("SELECT * FROM comments ORDER BY created_at DESC");
    //$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display comments
    //foreach ($comments as $comment) {
        //echo "<p><strong>{$comment['name']}:</strong> {$comment['comment']} ({$comment['created_at']})</p>";
    //}
//} catch (PDOException $e) {
    //die("Error: " . $e->getMessage());
//}
?>

<?php

class CommentManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function displayComments() {
        try {
            // Retrieve comments from the database
            $stmt = $this->pdo->query("SELECT * FROM comments ORDER BY created_at DESC");
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Display comments
            foreach ($comments as $comment) {
                echo "<p><strong>{$comment['name']}:</strong> {$comment['comment']} ({$comment['created_at']})</p>";
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>

