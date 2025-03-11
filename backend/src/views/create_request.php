<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacation Request</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<h2>Request Vacation</h2>

<p><a href="/employee_dashboard">Back to Employee Dashboard</a></p><br>
<form id="vacationForm"
      onsubmit="create_request(document.getElementById('dateFrom').value,document.getElementById('dateTo').value,document.getElementById('reason').value)">
    <label for="dateFrom">Date From:</label>
    <input type="date" id="dateFrom" required>
    <br><br>

    <label for="dateTo">Date To:</label>
    <input type="date" id="dateTo" required>
    <br><br>

    <label for="reason">Reason:</label>
    <textarea id="reason" rows="3" required></textarea>
    <br><br>

    <button type="submit">Submit Request</button>
</form>

<script>
    function create_request(dateFrom, dateTo, reason) {
        event.preventDefault();
        axios.post('/employee_dashboard/createRequest', {dateFrom, dateTo, reason})
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

