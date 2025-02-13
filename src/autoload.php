<?php

//use src\classes\db_connection;

use src\classes\db_connection;

/*spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    $file = __DIR__ . "/classes/" . basename($class) . ".php";

    if (!file_exists($file)) {
        die("Autoload error: File not found: " . $file);
    }

    require_once $file;
});*/

require_once __DIR__ . "/core/Routing.php";
require_once __DIR__ . "/routes.php";
require_once __DIR__ . "/classes/User.php";
require_once __DIR__ . "/classes/Admin.php";
require_once __DIR__ . "/classes/Employee.php";
require_once __DIR__ . "/classes/db_connection.php";

db_connection::getInstance();


