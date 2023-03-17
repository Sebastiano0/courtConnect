<?php
    require_once(__DIR__ . "/../model/activity.php");
    $material = Activity::loadActivities();
    echo json_encode($material);
?>