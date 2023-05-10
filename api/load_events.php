<?php
session_start();

    require_once(__DIR__ . "/../model/event.php");
    $event = Event::loadEvents($_GET["id"]);
    echo json_encode($event);
