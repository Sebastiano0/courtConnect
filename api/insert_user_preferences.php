<?php

require_once(__DIR__ . "/../model/user_preferences.php");


for($i = 0; $i < 10; $i++){
    $preference = new UserPreference();
    $preference->userId = $_POST["name"];
    $preference->activityId = $_POST["name"];
    $res = $preference->save();
    echo $res;
}

?>