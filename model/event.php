<?php

require_once(__DIR__ . "/utils.php");

class Event
{
    var $id;
    var $date;
    var $hour;
    var $sport;
    var $creator_id;
    var $notes;
    var $required_level;
    var $promo_typo;
    var $lat;
    var $lng;
    var $max_age;
    var $min_age;
    var $insert_date;
    var $insert_hour;

    public function save()
    {
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO events(date, hour, sport, creator_id, notes, required_level, promo_typo, lat, lng, max_age, min_age, insert_date, insert_hour) " .
                "VALUES ('$this->date', '$this->hour', '$this->sport', '$this->creator_id', '$this->notes', '$this->required_level', '$this->promo_typo', " . 
                "'$this->lat',  '$this->lng', '$this->max_age', '$this->min_age', '$this->insert_date', '$this->insert_hour')";
            $result = $conn->query($query);

            return $result;
        }
    }

    public static function loadEvents($id)
    {
        $conn = dbConnect();

        $result = $conn->query("SELECT * FROM events WHERE creator_id != $id AND date >= CURDATE() ");
        $res = array();

        while ($row = $result->fetch_assoc()) {
            $tmp = new Event();
            $tmp->id = $row["id"];
            $tmp->date = $row["date"];
            $tmp->hour = $row["hour"];
            $tmp->sport = $row["sport"];
            $tmp->creator_id = $row["creator_id"];
            $tmp->notes = $row["notes"];
            $tmp->required_level = $row["required_level"];
            $tmp->promo_typo = $row["promo_typo"];
            $tmp->lng = $row["lng"];
            $tmp->lat = $row["lat"];
            $tmp->max_age = $row["max_age"];
            $tmp->min_age = $row["min_age"];
            $tmp->insert_date = $row["insert_date"];
            $tmp->insert_hour = $row["insert_hour"];
            $res[] = $tmp;
        }
        
        $conn->close();
        return $res;

    }

    public static function getEventById($id)
    {
        $conn = dbConnect();
        $query = "SELECT * FROM events WHERE id='$id'";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $res = new Event();
            $res->id = $row["id"];
            $res->date = $row["date"];
            $res->hour = $row["hour"];
            $res->sport = $row["sport"];
            $res->creator_id = $row["creator_id"];
            $res->notes = $row["notes"];
            $res->required_level = $row["required_level"];
            $res->promo_typo = $row["promo_typo"];
            $res->lng = $row["lng"];
            $res->lat = $row["lat"];
            $res->max_age = $row["max_age"];
            $res->min_age = $row["min_age"];
            $res->insert_date = $row["insert_date"];
            $res->insert_hour = $row["insert_hour"];
            $conn->close();
            return $res;
        } else {
            return null;
        }

    }
}

?>