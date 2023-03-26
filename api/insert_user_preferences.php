<?php

require_once(__DIR__ . "/../model/user_preferences.php");

$preference = new UserPreference();
$preference->user = $_POST["user"];
$preference->activity = $_POST["activity"];
$res = $preference->save();
echo $res;

?>