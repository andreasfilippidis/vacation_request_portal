<?php

namespace backend\src\classes;

require_once __DIR__ . "/../autoload.php";


class User
{
    private string $name;
    private string $username;
    private string $password;
    private string $email;
    private int $id;
    protected string $type;
    protected $db;


    public static function user_login($username, $password)
    {
        $db = db_connection::getInstance();

        $stmt = $db->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return ["id" => $user['id'], "type" => $user['type']];
        }
        return false;
    }

}