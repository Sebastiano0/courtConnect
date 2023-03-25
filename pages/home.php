<?php
session_start();
if (!array_key_exists("email", $_SESSION)) {
    header('Location: ' . '../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court Connect</title>
    <link rel="stylesheet" href="../styles/home.css">
</head>
<body>
    <img class="logo" src="../assets/images/logo.svg" alt="logo">
    <button class="button" id="logout-button" onclick="window.location.href = '../index.php'">Logout</button>
    <div class="post"></div>
    <div class="menu"></div>
    <button class="button" id="create-post" onclick="alert('ghesburo')">Create post</button>
</body>
</html>