<?php

namespace backend\src\classes;

use DateTime;

require_once __DIR__ . "/../autoload.php";

class Employee extends User
{

    public static function create_request(string $dateFrom, string $dateTo, string $reason, int $id)
    {

        $db = db_connection::getInstance();

        $from = new DateTime($dateFrom);
        $to = new DateTime($dateTo);
        $today = new DateTime();
        if (($from > $to) || ($today >= $from) || ($to > (clone $from)->modify('+1 month'))) {
            return false;
        }

        $stmt = $db->prepare("INSERT INTO Vacation_request (requester_id,date_from, date_to, reason) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$id, $dateFrom, $dateTo, $reason])) {
            return true;
        }
        return false;
    }

    public static function view_requests()
    {
        $db = db_connection::getInstance();

        $stmt = $db->prepare("
        SELECT 
            v.id,
            v.requester_id,
            v.date_submitted,
            v.date_from,
            v.date_to,
            v.status,
            u.name AS requester_name
        FROM Vacation_request v
        JOIN Users u ON v.requester_id = u.id
        ");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public static function delete_request(int $requester_id, int $request_id, string $status, int $session_id)
    {
        $db = db_connection::getInstance();

        if ($requester_id != $session_id) {
            return ["success" => false, "message" => "You can't delete a request if you haven't made it"];
        } else if ($status != 'Pending') {
            return ["success" => false, "message" => "You can't delete this request since it is not pending"];
        } else {
            $stmt = $db->prepare("DELETE FROM Vacation_request WHERE id= :request_id");
            $stmt->bindParam(":request_id", $request_id);
            $stmt->execute();
        }
        return ["success" => true, "message" => "Request deleted"];
    }

}