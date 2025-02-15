<?php

namespace src\classes;
use PDO;
use PDOException;

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

    public static function update_user(int $id,string $column,string $value){
        $db = db_connection::getInstance();
        $stmt = $db->prepare("UPDATE Users SET {$column}= :value WHERE id= :id AND type <> 'Admin'");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($column =="password"){
            $value = password_hash($value, PASSWORD_ARGON2ID);
        }

        $stmt->bindParam(":value", $value, PDO::PARAM_STR);

        try {
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            $message = "Error updating user: " . $e->getMessage();
            return false;
        }

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
        } catch (PDOException $e) {
            return "Error deleting user: " . $e->getMessage();
        }
    }

    public static function manage_requests(){
        $db = db_connection::getInstance();

        $stmt = $db->prepare("
        SELECT 
            v.id,
            v.date_from, 
            v.date_to, 
            v.status, 
            u.name AS requester_name
        FROM Vacation_request v
        JOIN Users u ON v.requester_id = u.id
        WHERE v.status = 'Pending'
    ");

        $stmt->execute();
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }else{
            return false;
        }
    }

    public static function evaluate_request(int $id,string $eval){
        $db = db_connection::getInstance();


        $stmt = $db->prepare("UPDATE Vacation_request SET status = ? WHERE id = ? AND status = 'Pending'");
        $result = $stmt->execute([$eval, $id]);

        if ($result && $stmt->rowCount() > 0) {
            return ["status" => "success", "message" => "Request updated to $eval"];
        } else {
            return ["status" => "error", "message" => "Request not found or already processed"];
        }
    }

}


