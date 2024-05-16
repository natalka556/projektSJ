<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

$db = new Database($host, $dbname, $username, $password);
$pdo = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment_id = $_POST['comment_id'];
    $new_comment = $_POST['comment'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$comment_id]);
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$comment || $comment['user_id'] != $_SESSION['user_id']) {
            die("Unauthorized action");
        }

        $update_stmt = $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        $update_stmt->execute([$new_comment, $comment_id]);

        header("Location: ttm.php");
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    $comment_id = $_GET['comment_id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$comment_id]);
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$comment || $comment['user_id'] != $_SESSION['user_id']) {
            die("Unauthorized action");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
</head>
<body>
    <h2>Edit Your Comment</h2>
    <form action="editComment.php" method="post">
        <input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($comment['id']); ?>">
        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50"><?php echo htmlspecialchars($comment['comment']); ?></textarea><br>
        <input type="submit" value="Update Comment">
    </form>
</body>
</html>
