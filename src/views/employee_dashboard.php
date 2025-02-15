<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
</head>
<body>
<h1>Welcome to the Employee Dashboard</h1>

<form action="/employee_dashboard/createRequest" method="get">
    <button type="submit">Create Vacation Request</button>
</form><br>
<form action="/employee_dashboard/viewRequests" method="get">
    <button type="submit">View vacation request list</button>
</form><br>
<form action="/logout" method="post">
    <button type="submit">Logout</button>
</form>
</body>
</html>
