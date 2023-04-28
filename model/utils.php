<?php

function dbConnect()
{
    $servername = "129.152.22.2";
    $username = "root";
    $password = "";
    $database = "courtconnect";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed " . $conn->connect_error);
        //exit(0);
    }
    return $conn;
}