<?php

require_once(__DIR__ . "/utils.php");

class User
{
    var $id;
    var $name;
    var $surname;
    var $birthDate;
    var $gender;
    var $phone;
    var $townId;
    var $email;
    var $password;
    var $taxId;


    public function save()
    {
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO users(name, surname, birthDate, gender, phone, town_id, email, password, tax_id) " .
                "VALUES ('$this->name', '$this->surname', '$this->birthDate', '$this->gender', '$this->phone', '$this->townId', '$this->email', '$this->password', '$this->taxId') ";

            $result = $conn->query($query);

            return $result;
        }
    }

    public static function getLastId(){
        $conn = dbConnect();
        $query = "SELECT id FROM users ORDER BY id DESC LIMIT 0,1";
        $result = $conn->query($query);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["id"];
        } else {
            return null;
        }
    }
    
    public static function loginUser($email, $password)
    {
        $conn = dbConnect();

        $result = $conn->query("SELECT * FROM users WHERE email='$email'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                $res = new User();
                $res->id = $row["id"];
                $res->name = $row["name"];
                $res->surname = $row["surname"];
                $res->birthDate = $row["birthdate"];
                $res->gender = $row["gender"];
                $res->phone = $row["phone"];
                $res->townId = $row["town_id"];
                $res->taxId = $row["tax_id"];
                $res->password= $row["password"];
                $res->email = $row["email"];

                return $res;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}

?>