<?php
    require_once(__DIR__ . "/../model/genders.php");
    $ac = Gender::loadGenders();
    echo json_encode($ac);
?>