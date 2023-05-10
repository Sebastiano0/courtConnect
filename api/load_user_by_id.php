<?php
require_once(__DIR__ . "/../model/user.php");
$user = User::getUserById($_GET["id"]);
echo json_encode($user);
?>
