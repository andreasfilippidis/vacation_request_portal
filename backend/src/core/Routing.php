<?php

namespace backend\src\core;
require_once __DIR__ . "/../autoload.php";

class Routing
{
    private static array $routes = [];

    public static function get(string $path, callable $callback): void
    {
        self::$routes['GET'][$path] = $callback;
    }

    public static function post(string $path, callable $callback): void
    {
        self::$routes['POST'][$path] = $callback;
    }

    public static function resolve(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


        //echo "<br>method=" . $method . "<br>" . "uri=" . $uri . '<br>';


        if (isset(self::$routes[$method][$uri])) {

            call_user_func(self::$routes[$method][$uri]);
            //exit;

        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "Route not found"]);
            //exit;
        }
    }
}