<?php 

require_once(__DIR__ . "/utils.php");

class UserPreference{
    var $id;
    var $user;
    var $activity;

    //map
    public function save(){
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO userPreferences(user, activity) " .
                "VALUES ('$this->user', '$this->activity') ";

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
                $tmp->userId = $row["user"];
                $tmp->activityId = $row["activity"];
                $res[] = $tmp;
            }
            
            $conn->close();
            return $res;
        
    }
}

?>