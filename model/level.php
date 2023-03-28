<?php 

require_once(__DIR__ . "/utils.php");

class Level{
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

    public static function getLevelById($required_id)
    {
        $conn = dbConnect();
        $query = "SELECT * FROM levels WHERE id='$required_id'";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $res = new Level();
            $res->id = $row["id"];
            $res->name = $row["name"];
            $conn->close();
            return $res;
        } else {
            return null;
        }
    }

    public static function LoadLevels(){
            $conn = dbConnect();

            $result = $conn->query("SELECT * FROM levels");

            $res = array();

            while($row = $result->fetch_assoc()){
                $tmp = new Level();
                $tmp->id = $row["id"];
                $tmp->name = $row["name"];
                $res[] = $tmp;
            }
            
            $conn->close();
            return $res;
        
    }
}

?>