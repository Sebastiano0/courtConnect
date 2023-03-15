<?php

function dbConnect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "musicdb";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed " . $conn->connect_error);
        //exit(0);
    }
    return $conn;
}