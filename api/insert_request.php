<?php
    require_once(__DIR__ . "/../model/request.php");

    $request = new Request();
    $request->event_id = $_POST["event_id"];
    $request->user_id = $_POST["user_id"];
    $request->state = $_POST["state"];
    $res = $request->save();

    echo $res;

?>