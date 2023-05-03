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

            $query = "INSERT INTO user_preferences(user_id, activity_id) " .
                "VALUES ('$this->user_id', '$this->activity_id') ";

            $result = $conn->query($query);

            return $result;
        }
    }

    public static function loadUserPreferences($user_id){
            $conn = dbConnect();

            $result = $conn->query("SELECT * FROM user_preferences WHERE user_id = $user_id");

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