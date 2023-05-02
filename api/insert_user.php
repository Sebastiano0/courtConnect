<?php
    require_once(__DIR__ . "/../model/user.php");

    $user = new User();
    $user->name = $_POST["name"];
    $user->surname = $_POST["surname"];
    $user->birth_date = $_POST["birthDate"];
    $user->gender = $_POST["gender"];
    $user->phone = $_POST["phone"];
    $user->townId = $_POST["townId"];
    $user->email = $_POST["email"];
    $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $user->taxId = $_POST["taxId"];

    $res = $user->save();

    echo $res;

?>