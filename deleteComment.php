<?php
session_start();

// Include database connection
include 'db_connection.php';

// Create a Database instance and connect
$db = new Database($host, $dbname, $username, $password);
$pdo = $db->connect();

// Check if the comment ID is provided
if(isset($_POST['comment_id'])) {
    // Retrieve comment ID from POST data
    $commentId = $_POST['comment_id'];

    try {
        // Prepare SQL statement to delete comment by ID
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        // Execute the statement with comment ID
        $stmt->execute([$commentId]);
        
        // Redirect back to ttm.php after deleting comment
        header("Location: ttm.php");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    // If comment ID is not provided, redirect back to ttm.php
    header("Location: ttm.php");
    exit();
}
?>
