<?php
session_start();
if (array_key_exists("email", $_SESSION)) {
    header('Location: ' . './pages/home.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court Connect</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="icon" href="assets/images/logo.svg">
</head>
<body>
    <img class="logo" src="assets/images/logo.svg" alt="logo">
    <h1 id="title">Court Connect</h1>
    <!-- <div>banjo</div> -->
    <button class="access-button" id="login-button" onclick="window.location.href = './pages/login.php'">Login</button>
    <button class="access-button" id="signup-button" onclick="window.location.href = './pages/signup.php'">SignUp</button>
    <p  id="slogan">Connect with people and challenge them at your favourite sports.</p >
</body>
</html>