<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<h2>Login</h2>
<form onsubmit="login(event)">
    <input type="text" id="username" placeholder="Username" required>
    <input type="password" id="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<script>
    function login(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        axios.post('/login', { username, password })
            .then(response => {
                console.log(response.data.user_type);
                if (response.data.status === "success") {
                    // Redirect based on user type
                    if (response.data.user_type === "Admin") {
                        window.location.href = "/admin_dashboard";
                    } else {
                        window.location.href = "/employee_dashboard";
                    }
                } else {
                    alert(response.data.message);
                }
            })
            .catch(error => console.error(error));
    }
</script>
</body>
</html>
