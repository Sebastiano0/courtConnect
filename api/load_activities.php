<?php
    require_once(__DIR__ . "/../model/activity.php");
    $ac = Activity::loadActivities();
    echo json_encode($ac);
?>