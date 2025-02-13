<?php


require_once __DIR__ . "/autoload.php";

use src\classes\Admin;
use src\classes\User;
use src\classes\Employee;
use src\core\Routing;


Routing::get("/",function(){
    session_start();

    // If the user is already logged in
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        if ($_SESSION['user_type'] === "Admin") {
            header("Location: /admin_dashboard");
            exit();
        } elseif ($_SESSION['user_type'] === "Employee") {
            header("Location: /employee_dashboard");
            exit();
        }
    }

    // If no active session, show the public homepage
    require_once __DIR__ . "/../html/views/home.php";
});

Routing::get("/login",function(){
    require_once __DIR__ . "/../html/views/login.php";
});

Routing::get("/admin_dashboard/userList",function(){
    require_once __DIR__ . "/views/user_list.php";
});

Routing::post("/admin_dashboard/userList",function(){

});

routing::get("/admin_dashboard/createUser",function(){
    require_once __DIR__ . "/views/create_user.php";
});

Routing::post("/admin_dashboard/createUser", function() {
    header("Content-Type: application/json");
    //echo json_encode(["status" => "success", "message" => "User created!"]);
    // Ensure the user is logged in and is an admin
    /*if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "admin") {
        echo json_encode(["status" => "error", "message" => "Unauthorized"]);
        return;
    }*/

    $data = json_decode(file_get_contents("php://input"), true);



    $name = $data['name'] ?? '';
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
    $email = $data['email'] ?? '';
    $id = $data['id'] ?? '';
    $type = $data['type'] ?? '';

    echo json_encode(["name" => $name, "username" => $username, "password" => $password, "email" => $email, "id" => $id, "type" => $type]);



    if (!$name || !$username || !$password || !$email || !$id || !$type) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        return;
    }

    $response = Admin::create_user($name,$username,$password,$email,$id,$type);

    echo json_encode(["status" => "success", "message" => $response]);

});


Routing::post("/login", function() {
    session_start();
    header("Content-Type: application/json");

    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    if (!$username || !$password) {
        echo json_encode(["status" => "error", "message" => "Missing credentials"]);
        return;
    }
    //print("Hello");
    $response = User::user_login($username,$password);

    if ($response) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_type'] = $response['type'];

        echo json_encode(["status" => "success", "user_type" => $response['type']]);

    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);

    }

});

Routing::post("/logout", function() {
    session_start();
    session_destroy();
    header("Location: /");
    exit();
});

Routing::get("/admin_dashboard", function() {
    session_start();
    // Check if the user is logged in and is an Admin
    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Admin") {
        header("Location: /login");
        exit();
    }
    //print($_SESSION['logged_in'] . "<br>");
    // Include the secure admin dashboard views
    require_once __DIR__ . "/../src/views/admin_dashboard.php";
});


Routing::get("/employee_dashboard", function() {
    session_start();
    // Check if the user is logged in and is an Admin
    if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== "Employee") {
        header("Location: /login");
        exit();
    }
    //print($_SESSION['logged_in'] . "<br>");
    // Include the secure admin dashboard views
    require_once __DIR__ . "/../src/views/employee_dashboard.php";
});
