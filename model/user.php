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

            $query = "INSERT INTO users(name, surname, birthDate, gender, phone, townId, email, password, taxId) " .
                "VALUES ('$this->name', '$this->surname', '$this->birthDate', '$this->gender', '$this->phone', '$this->townId', '$this->email', '$this->password', '$this->taxId') ";

            $result = $conn->query($query);

            return $result;
        }
    }

    public static function loginUser($email, $password)
    {
        $conn = dbConnect();

        $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                $res = new User();
                $res->id = $row["id"];
                $res->name = $row["name"];
                $res->surname = $row["surname"];
                $res->birthDate = $row["birthDate"];
                $res->gender = $row["gender"];
                $res->phone = $row["phone"];
                $res->townId = $row["townId"];
                $res->taxId = $row["taxId"];
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