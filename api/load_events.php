<?php
    require_once(__DIR__ . "/../model/events.php");
    $event = Event::loadEvents($_GET["id"]);
    echo json_encode($event);

?>