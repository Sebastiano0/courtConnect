<?php
    require_once(__DIR__ . "/../model/request.php");

    $request = new Request();

    $id = $_POST["id"];
    $new_state = $_POST["new_state"];
    $res = $request->updateState($new_state, $id);

    echo $res;

?>