<?php

require_once(__DIR__ . "/utils.php");

class User
{
    var $id;
    var $username;
    var $password;
    var $email;

    public function save()
    {
        if ($this->id == null) {
            $conn = dbConnect();

            $query = "INSERT INTO users(username, email, password) " .
                "VALUES ('$this->username', '$this->email', '$this->password') ";

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
                $res->username = $row["username"];
                //$res->password= $row["password"];
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