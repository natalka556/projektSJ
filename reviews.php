<?php
session_start();
if (!isset($_SESSION['user_id'])) { // Check if user is logged in
    header('Location: login.php');
    exit();
}

// Assuming you have already retrieved user information including 'is_admin' from the session
$is_admin = $_SESSION['is_admin']; // Assuming 'is_admin' is stored in the session

// Check if user is not an admin
if (!$is_admin) {
    header('Location: login.php'); // Redirect non-admin users to login page
    exit();
}

include_once 'db_user.php';
include_once 'header.php';

// Fetch reviews
$reviews = $pdoUser->query("SELECT * FROM reviews")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Reviews</title>
</head>
<body>
<div class="container">
    <h1>Manage Reviews</h1>
    <table>
        <tr>
            <th>Movie</th>
            <th>User</th>
            <th>Review</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($reviews as $review): ?>
            <tr>
                <td><?= htmlspecialchars($review['movie_id']) ?></td>
                <td><?= htmlspecialchars($review['user_id']) ?></td>
                <td><?= htmlspecialchars($review['content']) ?></td>
                <td><?= htmlspecialchars($review['rating']) ?></td>
                <td>
                    <a href="delete_review.php?id=<?= $review['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>


<?php include 'footer.php'; ?>
