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

    public static function get_users(){
        $db = db_connection::getInstance();


        $stmt = $db->query("SELECT id,name, email, type FROM Users");
        return $stmt->fetchAll();

    }

    public static function delete_user(int $id){
        $db= db_connection::getInstance();
        $sql = "DELETE FROM Users WHERE id = :id AND type <> 'Admin'";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        try {
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return "Error deleting user: " . $e->getMessage();
        }
    }
}


