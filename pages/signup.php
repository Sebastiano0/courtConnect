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
    <img class="logo" src="../assets/images/logo.svg" alt="logo">
    <form id="regForm" name="regForm" action="./homepage.php">
        <h1>Register</h1>
        <div class="tab">
            <div class="row">
                <p>First name</p>
                <input placeholder="First name..." oninput="this.className = ''" name="fname" id="name">
                <p>Last name</p>
                <input placeholder="Last name..." oninput="this.className = ''" name="lname">
            </div>
            <div class="row">
                <p>Birth date</p>
                <input type="date" oninput="this.className = ''" name="bdate">
                <p>Fiscal code</p>
                <input type="text" placeholder="Fiscal code..." oninput="this.className = ''" name="fcode">
                <p>City of residence</p>
                <input placeholder="Address..." oninput="this.className = ''" name="address">
                <p for="cars">Select a gender:</p>
                <select name="cars" id="cars">
                    <?php
                    require_once(__DIR__ . "/../model/gender.php");
                    $genders = Gender::loadGenders();
                    $ris = "";
                    for ($i = 0; $i < count($genders); $i++) {
                        $gender = $genders[$i]->gender;
                        $id = $genders[$i]->id;
                        $ris = $ris . "<option value=" . $gender . ">" . $gender . "</option>";
                    }
                    echo $ris;

                    ?>
                </select>
            </div>

        </div>
        <div class="tab">
            <p>Email</p>
            <input placeholder="E-mail..." type="email" oninput="this.className = ''" name="email">
            <p>Confirm email</p>
            <input placeholder="Confirm e-mail..." type="email" oninput="this.className = ''" name="c-email">
            <p>Phone</p>
            <input placeholder="Phone..." type="tel" oninput="this.className = ''" name="phone">
            <p>Password</p>
            <input placeholder="Password..." oninput="this.className = ''" name="pword" type="password">
            <p>Confirm password</p>
            <input placeholder="Confirm password..." oninput="this.className = ''" name="c-pword" type="password">
        </div>
        <div class="tab">
            Choose your favourite sports
            <p>
            <div id="" style="overflow-y: scroll; height:400px;">
                <?php
                require_once("../model/activity.php");

                $activities = Activity::loadActivities();
                $ris = "";
                for ($i = 0; $i < count($activities); $i++) {
                    $name = $activities[$i]->name;
                    $id = $activities[$i]->id;
                    $ris = $ris . "<label><input type='checkbox' name='sport[]' value='" . $id . "'>" . $name . "</label>";
                }
                echo $ris;
                ?>
            </div>
            </p>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
    <button type="button" id="prova" onclick="addPreferences()">Prova</button>

</body>
<script src="../js/signup.js"></script>

</html>