<?php

class CommentForm {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function submitForm() {
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $name = $_POST["name"];
            $comment = $_POST["comment"];

            // Basic validation - you might want to improve this
            if (!empty($name) && !empty($comment)) {
                // Get user ID from session
                session_start();
                $userId = $_SESSION['user_id'];

                try {
                    // Prepare SQL statement
                    $stmt = $this->pdo->prepare("INSERT INTO comments (name, comment, user_id) VALUES (?, ?, ?)");
                    // Execute SQL statement with user ID as third parameter
                    $stmt->execute([$name, $comment, $userId]);

                    // Redirect back to the comment section
                    header("Location: ttm.php");
                    exit();
                } catch (PDOException $e) {
                    die("Error: " . $e->getMessage());
                }
            } else {
                echo "Please fill in all fields.";
            }
        }
    }

    // Funkcia na odstránenie komentára
    public function deleteComment($commentId) {
        try {
            // Prepare SQL statement
            $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = ?");
            // Execute SQL statement with comment ID as parameter
            $stmt->execute([$commentId]);
            // Redirect back to the comment section
            header("Location: ttm.php");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

// Include database connection
include 'db_connection.php';

// Create a CommentForm instance
$commentForm = new CommentForm($pdo);

// Ak bola žiadosť POST a existuje paramater "action"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Ak je akcia "delete" a existuje paramater "comment_id"
    if ($_POST['action'] == 'delete' && isset($_POST['comment_id'])) {
        // Zavolanie funkcie deleteComment
        $commentForm->deleteComment($_POST['comment_id']);
    }
}

// Submit the form
$commentForm->submitForm();
?>
