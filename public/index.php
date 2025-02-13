<?php

use src\core\Routing;
require_once __DIR__ . "/../src/autoload.php";
/*//require_once __DIR__ . "/../src/core/Routing.php";
require_once __DIR__ . "/../src/routes.php";



Routing::resolve(); // Process the request
//session_start();

$page = $_GET['page'] ?? 'login';  // Default to login page

// Redirect based on login status
if (!isset($_SESSION['logged_in']) && $page !== 'login') {
    $page = 'login';  // Redirect to login if not authenticated
} elseif ($page === 'admin_dashboard' && $_SESSION['user_type'] !== 'admin') {
    $page = 'login';  // Prevent employees from accessing admin
} elseif ($page === 'employee_dashboard' && $_SESSION['user_type'] !== 'employee') {
    $page = 'login';  // Prevent admins from accessing employee page
}

// Include the correct page
$view_path = "views/$page.php";
if (file_exists($view_path)) {
    include $view_path;
} else {
    echo "404 - Page Not Found";
}*/


//require_once __DIR__ . "/../src/core/Routing.php";
//require_once __DIR__ . "/../src/routes.php";
//if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Routing::resolve();
    exit(); // Stop execution so no additional HTML is output.
//}

/*$page = $_GET['page'] ?? 'home'; // Default to home page
$view_path = "views/$page.php";

if (file_exists($view_path)) {
    include $view_path;
} else {
    echo "404 - Page Not Found";
}*/


