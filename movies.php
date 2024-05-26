<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include_once 'db_user.php';
include_once 'header.php';

// Fetch movies
$movies = $pdoUser->query("SELECT * FROM movies")->fetchAll();
?>

<div class="container">
    <h1>Manage Movies</h1>
    <a href="add_movie.php" class="btn">Add New Movie</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($movies as $movie): ?>
            <tr>
                <td><?= htmlspecialchars($movie['title']) ?></td>
                <td><?= htmlspecialchars($movie['genre']) ?></td>
                <td><?= htmlspecialchars($movie['rating']) ?></td>
                <td>
                    <a href="edit_movie.php?id=<?= $movie['id'] ?>">Edit</a>
                    <a href="delete_movie.php?id=<?= $movie['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include 'footer.php'; ?>
