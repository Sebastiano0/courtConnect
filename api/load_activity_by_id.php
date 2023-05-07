<?php
require_once(__DIR__ . "/../model/activity.php");
$activity = Activity::getActivitiesById($_GET["id"]);
echo json_encode($activity);
?>
