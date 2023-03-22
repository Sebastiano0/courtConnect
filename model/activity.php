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

            $result = $conn->query("SELECT * FROM activity");

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
}

?>