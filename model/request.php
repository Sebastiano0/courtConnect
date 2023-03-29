<?php

require_once(__DIR__ . "/utils.php");

class Request
{
    var $id;
    var $event_id;
    var $user_id;
    var $state;


    public function save()
    {
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO requests(event_id, user_id, state) " .
                "VALUES ('$this->event_id', '$this->user_id', '$this->state') ";

            $result = $conn->query($query);

            return $result;
        }
    }

    public static function loadRequests($id)
    {
        $conn = dbConnect();

        $result = $conn->query("SELECT u.name AS name, u.surname AS surname FROM requests r INNER JOIN events e ON r.event_id = e.id INNER JOIN users u ON e.creator_id = u.id AND u.id =  $id ");
        $res = array();

        while ($row = $result->fetch_assoc()) {
            $tmp = array();
            $tmp[] = $row["name"];
            $tmp[] = $row["surname"];

            $res[] = $tmp;
        }
        
        $conn->close();
        return $res;

    }

}

?>