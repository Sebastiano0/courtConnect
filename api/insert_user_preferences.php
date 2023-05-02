<?php

require_once(__DIR__ . "/../model/user_preferences.php");

$preference = new UserPreference();
$preference->user_id = $_POST["user"];
$preference->activity_id = $_POST["activity"];
$res = $preference->save();
echo $res;

?>