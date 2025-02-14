<!-- src/views/admin_users.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User List - Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<h1>User List</h1>
<p><a href="/admin_dashboard">Back to Admin Dashboard</a></p>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Type</th>
        <th>Update User</th>
        <th>Delete User</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['type']) ?></td>
            <td><form action="/admin_dashboard/updateUser" method="get">
                    <!-- The hidden field holds the user ID -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                    <button type="submit">Update User</button>
                </form></td>
            <td><form onsubmit="delete_user(<?= htmlspecialchars($user['id']) ?>)" action="/admin_dashboard/deleteUser" method="post">
                    <button type="submit">Delete</button>
                </form></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<script>
    function update_user(id) {
        event.preventDefault();
        axios.post('/admin_dashboard/updateUser', { id })
            .then(response => {
                if (response.data.status === "success") {
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            })
            .catch(error => console.error(error));
    }

    function delete_user(id) {
        event.preventDefault();

        axios.post('/admin_dashboard/deleteUser', { id })
            .then(response => {
                if (response.data.status === "success") {
                    //alert(response.data.message);
                    console.log(response.data.message);
                    window.location.reload();
                } else {
                    alert(response.data.message);
                }
            })
            .catch(error => console.error(error));
    }
</script>
</body>
</html>


