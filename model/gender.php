<?php 

require_once(__DIR__ . "/utils.php");

class Gender{
    var $id;
    var $gender;

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

    public static function loadGenders(){
            $conn = dbConnect();

            $result = $conn->query("SELECT * FROM genders");

            $res = array();

            while($row = $result->fetch_assoc()){
                $tmp = new Gender();
                $tmp->id = $row["id"];
                $tmp->gender = $row["gender"];
                $res[] = $tmp;
            }
            
            $conn->close();
            return $res;
        
    }

    public static function getGenderById($required_id)
    {
        $conn = dbConnect();
        $query = "SELECT * FROM genders WHERE id='$required_id'";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $res = new Gender();
            $res->id = $row["id"];
            $res->gender = $row["gender"];
            $conn->close();
            return $res;
        } else {
            return null;
        }
    }
}

?>