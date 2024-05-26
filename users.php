<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include_once 'db_user.php';
include_once 'header.php';

// Fetch users
$users = $pdoUser->query("SELECT * FROM users")->fetchAll();
?>

<div class="container">
    <h1>Manage Users</h1>
    <a href="add_user.php" class="btn">Add New User</a>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a>
                    <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include 'footer.php'; ?>
