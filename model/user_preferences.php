<?php 

require_once(__DIR__ . "/utils.php");

class UserPreference{
    var $id;
    var $user_id;
    var $activity_id;

    //map
    public function save(){
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO userPreferences(user_id, activity_id) " .
                "VALUES ('$this->user_id', '$this->activity_id') ";

            $result = $conn->query($query);

            return $result;
        }
    }

    public static function loadUserPreferences(){
            $conn = dbConnect();

            $result = $conn->query("SELECT * FROM userPreferences");

            $res = array();

            while($row = $result->fetch_assoc()){
                $tmp = new UserPreference();
                $tmp->id = $row["id"];
                $tmp->user_id = $row["user_id"];
                $tmp->activity_id = $row["activity_id"];
                $res[] = $tmp;
            }
            
            $conn->close();
            return $res;
        
    }
}

?>