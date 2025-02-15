<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Vacation Requests</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<h1>Vacation Request List</h1>
<p><a href="/employee_dashboard">Back to Employee Dashboard</a></p>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>Date Submitted</th>
        <th>Vacate From</th>
        <th>Vacate To</th>
        <th>Status</th>
        <th>Delete Request</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($requests as $request): ?>
        <tr>
            <td><?= htmlspecialchars($request['date_submitted']) ?></td>
            <td><?= htmlspecialchars($request['date_from']) ?></td>
            <td><?= htmlspecialchars($request['date_to']) ?></td>
            <td><?= htmlspecialchars($request['status']) ?></td>
            <td><form onsubmit="delete_request(<?= htmlspecialchars($request['requester_id']) ?>,<?= htmlspecialchars($request['id']) ?>,'<?= htmlspecialchars($request['status']) ?>')">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<script>
    function delete_request(requester_id,vacation_id,state) {
        event.preventDefault();
        axios.post('/employee_dashboard/deleteRequest', { requester_id,vacation_id,state })
            .then(response => {
                if (response.data.status === "success") {
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
