<?php

class CommentForm {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function submitForm() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $comment = $_POST["comment"];

            if (!empty($name) && !empty($comment)) {
                session_start();
                $userId = $_SESSION['user_id'];

                try {
                    $stmt = $this->pdo->prepare("INSERT INTO comments (name, comment, user_id) VALUES (?, ?, ?)");
                    $stmt->execute([$name, $comment, $userId]);

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

    public function deleteComment($commentId) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = ?");
            $stmt->execute([$commentId]);
            header("Location: ttm.php");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

include 'db_connection.php';

$commentForm = new CommentForm($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'delete' && isset($_POST['comment_id'])) {
        $commentForm->deleteComment($_POST['comment_id']);
    }
}

$commentForm->submitForm();
?>
