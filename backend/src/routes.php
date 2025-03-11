<?php


require_once __DIR__ . "/autoload.php";

use backend\src\classes\Admin;
use backend\src\classes\Employee;
use backend\src\classes\User;
use backend\src\core\Routing;


Routing::get("/", function () {
    header("Location: /login");
});

Routing::get("/login", function () {

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        if ($_SESSION['user_type'] === "Admin") {
            header("Location: /admin_dashboard");
            exit();
        } elseif ($_SESSION['user_type'] === "Employee") {
            header("Location: /employee_dashboard");
            exit();
        }
    }

    require_once __DIR__ . "/views/login.php";
});

Routing::get("/admin_dashboard/userList", function () {


    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'Admin') {
        header("Location: /login");
        exit();
    }


    require_once __DIR__ . "/classes/Admin.php";


    $users = Admin::get_users();

    require_once __DIR__ . "/views/user_list.php";
});


routing::get("/admin_dashboard/createUser", function () {
    require_once __DIR__ . "/views/create_user.php";
});

Routing::post("/admin_dashboard/createUser", function () {
    header("Content-Type: application/json");


    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        echo json_encode(["status" => "error", "message" => "Unauthorized"]);
        return;
    }

    $data = json_decode(file_get_contents("php://input"), true);


    $name = $data['name'] ?? '';
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
    $email = $data['email'] ?? '';
    $id = $data['id'] ?? '';
    $type = $data['type'] ?? '';


    if (!$name || !$username || !$password || !$email || !$id || !$type) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        return;
    }

    $response = Admin::create_user($name, $username, $password, $email, $id, $type);

    if ($response['status']=="success") {
        echo json_encode(["status" => "success", "message" => $response['message']]);
    } else {
        echo json_encode(["status" => "error", "message" => $response['message']]);
    }

});


Routing::post("/login", function () {
    header("Content-Type: application/json");


    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    if (!$username || !$password) {
        echo json_encode(["status" => "error", "message" => "Missing credentials"]);
        return;
    }
    //print("Hello");
    $response = User::user_login($username, $password);

    if ($response) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_type'] = $response['type'];
        $_SESSION['id'] = $response['id'];


        echo json_encode(["status" => "success", "user_type" => $response['type']]);

    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);

    }

});

Routing::post("/logout", function () {
    session_destroy();
    header("Location: /");
    exit();
});

Routing::get("/admin_dashboard", function () {

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        header("Location: /login");
        exit();
    }
    //print($_SESSION['logged_in'] . "<br>");

    require_once __DIR__ . "/../src/views/admin_dashboard.php";
});


Routing::get("/employee_dashboard", function () {


    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Employee") {
        header("Location: /login");
        exit();
    }


    require_once __DIR__ . "/../src/views/employee_dashboard.php";
});

Routing::get("/admin_dashboard/updateUser", function () {


    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        header("Location: /login");
        exit();
    }

    $id = $_GET['id'] ?? null;


    require_once __DIR__ . "/views/update_user.php";


});

Routing::post("/admin_dashboard/updateUser", function () {
    header("Content-Type: application/json");


    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        header("Location: /login");
        exit();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $column = $data['column'];
    $value = $data['value'];


    $response = Admin::update_user($id, $column, $value);

    if ($response) {
        echo json_encode(["status" => "success", "message" => "Successfully updated user's " . $column]);

    } else {
        echo json_encode(["status" => "error", "message" => "Couldn't update user's $column as he is an admin"]);

    }


    //require_once __DIR__ . "/views/update_user.php";


});

Routing::post("/admin_dashboard/deleteUser", function () {
    header("Content-Type: application/json");

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        header("Location: /login");
        exit();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    $response = Admin::delete_user($id);

    if ($response) {
        echo json_encode(["status" => "success", "message" => "User deleted successfully"]);

    } else {
        echo json_encode(["status" => "error", "message" => "You can't delete admin users"]);

    }
});


Routing::get("/employee_dashboard/createRequest", function () {

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Employee") {
        header("Location: /login");
        exit();
    }


    require_once __DIR__ . "/views/create_request.php";
});

Routing::post("/employee_dashboard/createRequest", function () {
    header("Content-Type: application/json");

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Employee") {
        header("Location: /login");
        exit();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $datefrom = $data['dateFrom'] ?? null;
    $dateto = $data['dateTo'] ?? null;
    $reason = $data['reason'] ?? null;

    $response = Employee::create_request($datefrom, $dateto, $reason, $_SESSION['id']);

    if ($response) {
        echo json_encode(["status" => "success", "message" => "Vacation request submitted successfully"]);

    } else {
        echo json_encode(["status" => "error", "message" => "Can't submit vacation request with these dates"]);

    }

});

Routing::get("/employee_dashboard/viewRequests", function () {

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Employee") {
        header("Location: /login");
        exit();
    }

    $requests = Employee::view_requests();

    require_once __DIR__ . "/views/view_requests.php";
});

Routing::post("/employee_dashboard/deleteRequest", function () {
    header("Content-Type: application/json");


    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Employee") {
        header("Location: /login");
        exit();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $requester_id = $data['requester_id'] ?? null;
    $request_id = $data['vacation_id'] ?? null;
    $status = $data['state'] ?? null;

    $response = Employee::delete_request($requester_id, $request_id, $status, $_SESSION['id']);

    if ($response['success']) {
        echo json_encode(["status" => "success", "message" => $response['message']]);

    } else {
        echo json_encode(["status" => "error", "message" => $response['message']]);

    }
});

Routing::get("/admin_dashboard/manageRequests", function () {

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        header("Location: /login");
        exit();
    }

    $requests = Admin::manage_requests();

    require_once __DIR__ . "/views/manage_requests.php";
});

Routing::post("/admin_dashboard/manageRequests", function () {
    header("Content-Type: application/json");

    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        header("Location: /login");
        exit();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $request_id = $data['request_id'] ?? null;
    $evaluation = $data['evaluation'] ?? null;

    $response = Admin::evaluate_request($request_id, $evaluation);

    if ($response) {
        echo json_encode(["status" => "success", "message" => $response['message']]);
    } else {
        echo json_encode(["status" => "error", "message" => $response['message']]);
    }

});