<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: /login");
    exit();
}

// Example: Fetching users from a database or a model
// Uncomment and modify the following lines if you have a database connection and a User model:
// require_once __DIR__ . '/../../src/config/database.php';
// require_once __DIR__ . '/../../src/models/User.php';
// $users = User::getAllUsers();

// For demonstration purposes, let's use a hard-coded array of users:
$users = [
    ['id' => 1, 'username' => 'admin',     'email' => 'admin@example.com',     'user_type' => 'Admin'],
    ['id' => 2, 'username' => 'employee1', 'email' => 'employee1@example.com', 'user_type' => 'Employee'],
    ['id' => 3, 'username' => 'employee2', 'email' => 'employee2@example.com', 'user_type' => 'Employee'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        a.button {
            display: inline-block;
            padding: 8px 12px;
            background-color: #4285f4;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>User List</h1>
    <a href="/admin_dashboard" class="button">Back to Dashboard</a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>User Type</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['user_type']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
