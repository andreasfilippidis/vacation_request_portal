<?php

namespace src\classes;
require_once __DIR__ . "/../autoload.php";


class Admin extends User
{


    public static function create_user(string $name, string $username, string $password, string $email, int $id, string $type){
        $db = db_connection::getInstance();

        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

        // Insert user into database
        $stmt = $db->prepare("INSERT INTO Users (name, username, password,email,id, type) VALUES (?, ?, ?, ?,?,?)");
        if ($stmt->execute([$name,$username,$hashedPassword, $email, $id, $type])) {
            return "User '$name' created successfully!";
        }
        return "Failed to create user.";
    }
}

