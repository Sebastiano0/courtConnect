<?php
    require_once(__DIR__ . "/../model/event.php");

    $event = new Event();
    $event->date = $_POST["date"];
    $event->hour = $_POST["hour"];
    $event->sport = $_POST["sport"];
    $event->creator_id = $_POST["creator_id"];
    $event->notes = $_POST["notes"];
    $event->required_level = $_POST["required_level"];
    $event->ad_typo = $_POST["ad_typo"];

    $res = $event->save();

    echo $res;

?>