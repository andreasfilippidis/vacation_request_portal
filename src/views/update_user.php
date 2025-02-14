<?php
// Assume $userId is available here; if not, you can extract it or use a dedicated View class.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
</head>
<body>
<p><a href="/admin_dashboard/userList">Back to User list</a></p>
<h1>Update User Information (ID: <?= htmlspecialchars($id) ?>)</h1>
<form action="/admin_dashboard/userUpdate" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    <div>
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" required>
    </div>
    <br>
    <div>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required>
    </div>
    <br>
    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required>
    </div>
    <br>
    <button type="submit">Update User</button>
</form>
</body>
</html>
