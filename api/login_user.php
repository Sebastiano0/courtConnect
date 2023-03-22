<?php
    session_start();
    require_once(__DIR__ . "/../model/user.php");

    $u = User::loginUser($_POST["email"], $_POST["password"]);

    if($u != null){
        $_SESSION["userID"] = $u->id;
        $_SESSION["name"] = $u->name;
        $_SESSION["surname"] = $u->name;
        echo "true";
    } else {
        echo "false";
    }
?>