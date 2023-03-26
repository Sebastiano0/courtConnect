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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css%22%3E
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <img class="logo" src="../assets/images/logo.svg" alt="logo">
    <button class="button" id="logout-button" onclick="window.location.href = '../index.php'">Logout</button>
    <div class="post"></div>
    <div class="menu">
        <div id="home">
            <i class="fa-regular fa-house"></i>
            <p>Home</p>
        </div>
        <div id="profile">
            <i class="fa-regular fa-house"></i>
            <p>Profile</p>
        </div>
        <div id="settings">
            <i class="fa-regular fa-house"></i>
            <p>Settings</p>
        </div>
    </div>
    <button class="button" id="create-post" onclick="alert('ghesburo')">Create post</button>
    <div class="requests"></div>
</body>

</html>