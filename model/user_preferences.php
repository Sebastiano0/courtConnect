<?php 

require_once(__DIR__ . "/utils.php");

class UserPreference{
    var $id;
    var $userId;
    var $activityId;

    //map
    public function save(){
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO activities(userId, activityId) " .
                "VALUES ('$this->userId', '$this->activityId') ";

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
                $tmp->userId = $row["userId"];
                $tmp->activityId = $row["activityId"];
                $res[] = $tmp;
            }
            
            $conn->close();
            return $res;
        
    }
}

?>