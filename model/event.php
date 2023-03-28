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
    var $ad_typo;
    var $address;
    var $max_age;
    var $min_age;
    var $insert_date;
    var $insert_hour;

    public function save()
    {
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO events(date, hour, sport, creator_id, notes, required_level, ad_typo, address, max_age, min_age, insert_date, insert_hour) " .
                "VALUES ('$this->date', '$this->hour', '$this->sport', '$this->creator_id', '$this->notes', '$this->required_level', '$this->ad_typo', " . 
                "'$this->address', '$this->max_age', '$this->min_age', '$this->insert_date', '$this->insert_hour')";
            $result = $conn->query($query);

            return $result;
        }
    }

    public static function loadEvents()
    {
        $conn = dbConnect();

        $result = $conn->query("SELECT * FROM events");
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
            $tmp->ad_typo = $row["ad_typo"];
            $tmp->address = $row["address"];
            $tmp->max_age = $row["max_age"];
            $tmp->min_age = $row["min_age"];
            $tmp->insert_date = $row["insert_date"];
            $tmp->insert_hour = $row["insert_hour"];
            $res[] = $tmp;
        }
        
        $conn->close();
        return $res;

    }
}

?>