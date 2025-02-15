<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Requests</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<h1>Manage Vacation Requests</h1>
<p><a href="/admin_dashboard">Back to Employee Dashboard</a></p>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>Request Id</th>
        <th>Requester Name</th>
        <th>Vacate From</th>
        <th>Vacate To</th>
        <th>Status</th>
        <th>Approve Request</th>
        <th>Reject Request</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($requests as $request): ?>
        <tr>
            <td><?= htmlspecialchars($request['id']) ?></td>
            <td><?= htmlspecialchars($request['requester_name']) ?></td>
            <td><?= htmlspecialchars($request['date_from']) ?></td>
            <td><?= htmlspecialchars($request['date_to']) ?></td>
            <td><?= htmlspecialchars($request['status']) ?></td>
            <td><form onsubmit="evaluate_request(<?= htmlspecialchars($request['id']) ?>,'Approved')">
                    <button type="submit">Approve</button>
                </form> </td>
            <td><form onsubmit="evaluate_request(<?= htmlspecialchars($request['id']) ?>, 'Rejected')">
                    <button type="submit">Reject</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<script>
    function evaluate_request(request_id,evaluation) {
        event.preventDefault();
        axios.post('/admin_dashboard/manageRequests', { request_id,evaluation })
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