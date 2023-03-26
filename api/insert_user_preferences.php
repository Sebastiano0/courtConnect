<?php

require_once(__DIR__ . "/../model/user_preferences.php");

$preference = new UserPreference();
$preference->userId = $_POST["userId"];
$preference->activityId = $_POST["activityId"];
$res = $preference->save();
echo $res;

?>