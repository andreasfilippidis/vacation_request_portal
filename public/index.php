<?php

use src\core\Routing;

require_once __DIR__ . "/../src/autoload.php";

session_start();
Routing::resolve();
exit();



