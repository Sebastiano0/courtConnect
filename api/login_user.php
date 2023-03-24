<?php
    session_start();
    require_once(__DIR__ . "/../model/user.php");

    $u = User::loginUser($_POST["email"], $_POST["password"]);

    if($u != null){
        $_SESSION["userID"] = $u->id;
        $_SESSION["email"] = $u->email;
        $_SESSION["name"] = $u->name;
        echo "1";
    } else {
        echo "some error occured";
    }
?>