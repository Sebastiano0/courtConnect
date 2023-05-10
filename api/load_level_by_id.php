<?php
require_once(__DIR__ . "/../model/level.php");
$level = Level::getLevelById($_GET["id"]);
echo json_encode($level);
?>
