<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<input type="text" id="name" placeholder="Enter user's name">
<input type="text" id="username" placeholder="Enter username">
<input type="password" id="password" placeholder="Enter password">
<input type="email" id="email" placeholder="Enter email">
<input type="number" id="id" placeholder="Enter id (must be 7 digits)">
Enter id (must be 7 digits)
<select id="type">
    <option value="Admin">Admin</option>
    <option value="Employee">Employee</option>
</select>
<button  type="button" onclick="create_user()">Create User</button>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function create_user() {

        const name = document.getElementById("name").value;
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const email = document.getElementById("email").value;
        const id = document.getElementById("id").value;
        const type = document.getElementById("type").value;

        axios.post("/admin_dashboard/createUser", {
            //action: "createUser",
            name: name,
            username: username,
            password: password,
            email: email,
            id: id,
            type: type

        })
            .then(response => console.log("Response:", response.data))
            .catch(error => console.error("Error:", error));
    }
</script>


</body>
</html>
