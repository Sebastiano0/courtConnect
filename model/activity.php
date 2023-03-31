<?php 

require_once(__DIR__ . "/utils.php");

class Activity{
    var $id;
    var $name;

    /*
    public function save(){
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO activity(name) " .
                "VALUES ('$this->name') ";

            $result = $conn->query($query);

            return $result;
        }
    }
    */

    public static function loadActivities(){
            $conn = dbConnect();

            $result = $conn->query("SELECT * FROM activities");

            $res = array();

            while($row = $result->fetch_assoc()){
                $tmp = new Activity();
                $tmp->id = $row["id"];
                $tmp->name = $row["name"];
                $res[] = $tmp;
            }
            
            $conn->close();
            return $res;
        
    }

    public static function getActivitiesById($required_id)
    {
        $conn = dbConnect();
        $query = "SELECT * FROM activities WHERE id='$required_id'";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $res = new Activity();
            $res->id = $row["id"];
            $res->name = $row["name"];
            $conn->close();
            return $res;
        } else {
            return null;
        }
    }
}

?>