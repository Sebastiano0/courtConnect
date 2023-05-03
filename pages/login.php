<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court Connect</title>
    <link rel="stylesheet" href="../styles/signup.css">
</head>

<body>
    <a href="nextPrev(-1)">
    <img class="logo" src="../assets/images/logo.svg" alt="logo">
    </a>
    <form id="regFormLogin" name="regForm" action="./homepage.php">
        <h1>Login</h1>
        <!-- One "tab" for each step in the form:  -->
        <div class="tab">
                <div>Email</div>
                <input placeholder="Email" oninput="this.className = ''" name="email">
                <div>Password</div>
                <input placeholder="Password" oninput="this.className = ''" name="pword" type="password">
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" onclick="window.location.href = '../index.php'">Back</button>
                <button type="button" id="nextBtn" onclick="login()">Submit</button>
            </div>
        </div>
    </form>
    <script src="../js/signup.js"></script>
    
    </body>
</body>

</html>