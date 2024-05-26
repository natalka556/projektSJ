<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include_once 'db_user.php';
include_once 'header.php';

// Fetch statistics
$totalMovies = $pdoUser->query("SELECT COUNT(*) FROM movies")->fetchColumn();
$totalUsers = $pdoUser->query("SELECT COUNT(*) FROM users")->fetchColumn();
$newReviews = $pdoUser->query("SELECT COUNT(*) FROM reviews WHERE created_at > NOW() - INTERVAL 1 DAY")->fetchColumn();
$newComments = $pdoUser->query("SELECT COUNT(*) FROM comments WHERE created_at > NOW() - INTERVAL 1 DAY")->fetchColumn();
?>

<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="stats">
        <div>Total Movies: <?= $totalMovies ?></div>
        <div>Total Users: <?= $totalUsers ?></div>
        <div>New Reviews (last 24h): <?= $newReviews ?></div>
        <div>New Comments (last 24h): <?= $newComments ?></div>
    </div>
</div>

<?php include 'footer.php'; ?>
