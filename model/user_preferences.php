<?php 

require_once(__DIR__ . "/utils.php");

class UserPreferences{
    var $id;
    var $userId;
    var $activityId;

    //map
    public function save(){
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO activity(userId, activityId) " .
                "VALUES ('$this->userId', '$this->activityId') ";

            $result = $conn->query($query);

            return $result;
        }
    }

    public static function loadActivities(){
            $conn = dbConnect();

            $result = $conn->query("SELECT * FROM activity");

            $res = array();

            while($row = $result->fetch_assoc()){
                $tmp = new UserPreferences();
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