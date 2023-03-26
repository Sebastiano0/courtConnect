<?php
    require_once(__DIR__ . "/../model/user.php");
    $id = User::getLastId();
    echo json_encode($id);
?>