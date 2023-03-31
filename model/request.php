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

        $result = $conn->query("SELECT u.name AS name, u.surname AS surname FROM requests r INNER JOIN events e ON r.event_id = e.id AND e.creator_id = $id INNER JOIN users u ON u.id = r.user_id WHERE r.state = 2");
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

    public static function loadRequestsCompleted($id)
    {
        $conn = dbConnect();
        
        $result = $conn->query("SELECT r.id, r.event_id, r.user_id, r.state FROM requests r INNER JOIN events e ON r.event_id = e.id AND e.creator_id = $id INNER JOIN users u ON u.id = r.user_id WHERE r.state = 2");
        $res = array();

        while ($row = $result->fetch_assoc()) {
            $tmp = new Request();
            $tmp->id = $row["id"];
            $tmp->event_id = $row["event_id"];
            $tmp->user_id = $row["user_id"];
            $tmp->state = $row["state"];
            $res[] = $tmp;
        }

        $conn->close();
        return $res;

    }

    public static function loadYourRequests($id)
    {
        $conn = dbConnect();
        
        $result = $conn->query("SELECT s.name AS state, e.sport AS activity, e.date AS date, e.hour AS hour FROM requests r INNER JOIN events e ON e.id = r.event_id INNER JOIN states s ON s.id = r.state  WHERE user_id=$id");
        $res = array();

        while ($row = $result->fetch_assoc()) {
            $tmp = array();
            $tmp[] = $row["state"];
            $tmp[] = $row["activity"];
            $tmp[] = $row["date"];
            $tmp[] = $row["hour"];
            $res[] = $tmp;
        }

        $conn->close();
        return $res;

    }

    public static function loadYourRequestsCompleted($id){
        $conn = dbConnect();
        
        $result = $conn->query("SELECT r.id AS id, s.name AS state, a.name AS activity, e.date AS date, e.hour AS hour, u.name AS name, u.surname AS surname, e.address AS address FROM requests r INNER JOIN events e ON e.id = r.event_id INNER JOIN users u ON u.id=e.creator_id INNER JOIN activities a ON a.id=e.sport INNER JOIN states s ON s.id=r.state WHERE r.user_id=$id");
        $res = array();

        while ($row = $result->fetch_assoc()) {
            $tmp = array();
            $tmp[] = $row["state"];
            $tmp[] = $row["activity"];
            $tmp[] = $row["date"];
            $tmp[] = $row["hour"];
            $tmp[] = $row["name"];
            $tmp[] = $row["surname"];
            $tmp[] = $row["address"];
            $tmp[] = $row["id"];
            $res[] = $tmp;
        }

        $conn->close();
        return $res;

    }

    public function updateState($new_state, $id){
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "UPDATE requests SET state = $new_state WHERE id = $id;";

            $result = $conn->query($query);

            return $result;
        }
    }

}

?>