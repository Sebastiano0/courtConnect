<?php
session_start();

    require_once(__DIR__ . "/../model/event.php");
    if (!isset($_GET["id"])) {
        $event = Event::loadEvents($_SESSION["userID"]);
    } else {
        $event = Event::loadEvents($_GET["id"]);
    }
    echo json_encode($event);

?>