<?php
// Assume $userId is available here; if not, you can extract it or use a dedicated View class.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<p><a href="/admin_dashboard/userList">Back to User list</a></p>
<h1>Update User Information (ID: <?= htmlspecialchars($id) ?>)</h1>

<form onsubmit="updateuser(<?= htmlspecialchars($id) ?>,'name',document.getElementById('namevalue').value);">
    <label for="namevalue">Name:</label><br>
    <input type="text" name="namevalue" id="namevalue" required>
    <button type="submit">Update User name</button>
</form>
<br>
<form onsubmit="updateuser(<?= htmlspecialchars($id) ?>,'password',document.getElementById('passwordvalue').value);">
    <label for="passwordvalue">Password:</label><br>
    <input type="password" name="passwordvalue" id="passwordvalue" required>
    <button type="submit">Update User password</button>
</form>
<br>
<form onsubmit="updateuser(<?= htmlspecialchars($id) ?>,'email',document.getElementById('emailvalue').value);">
    <label for="emailvalue">Email:</label><br>
    <input type="email" name="emailvalue" id="emailvalue" required>
    <button type="submit">Update User email</button>
</form>
<br>

<script>
    function updateuser(id,column,value) {
        event.preventDefault();

        axios.post('/admin_dashboard/updateUser', { id, column,value})
            .then(response => {

                if (response.data.status === "success") {
                    // Redirect based on user type
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            })
            .catch(error => console.error(error));
    }
</script>


</body>
</html>
