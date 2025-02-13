<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<h1>Welcome to the Admin Dashboard</h1>
<!-- Logout form -->
<form action="/admin_dashboard/createUser" method="get">
    <button type="submit">Create User</button>
</form>
<form action="/admin_dashboard/userList" method="get">
    <button type="submit">See user's list</button>
</form>
<form action="/logout" method="post">
    <button type="submit">Logout</button>
</form>
</body>
</html>
