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
    <title>Court connect</title>

    <link rel="stylesheet" href="../styles/signup.css">
    <link rel="stylesheet" href="../styles/create.css">

</head>

<body>
    <img class="logo" src="../assets/images/logo.svg" alt="logo">

    <form id="regForm" name="regForm" action="./homepage.php">
        <h1>Create post</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            <div class="row">
                <p>Sport</p>
                <?php
                require_once("../model/activity.php");

                $activities = Activity::loadActivities();
                $ris = "<select id='dropdown' name='sport'>";
                for ($i = 0; $i < count($activities); $i++) {
                    $name = $activities[$i]->name;
                    $id = $activities[$i]->id;
                    $ris .= "<option value='" . $id . "'>" . $name . "</option>";
                }
                $ris .= "</select>";
                echo $ris;
                ?>
            </div>
            <div class="row">
                <p>Min age</p>
                <input placeholder="Min age..." oninput="this.className = ''" name="mi-age" type="number">
                <p>Max age</p>
                <input placeholder="Max age..." oninput="this.className = ''" name="ma-age" type="number">
            </div>
            <div class="row">
                <p>Time and date</p>
                <input type="datetime-local" oninput="this.className = ''" name="date">
            </div>
            <div class="row">
                <p>Location</p>
                <input placeholder="Location..." oninput="this.className = ''" name="location">
            </div>
            <div class="row">
                <p>Skill level</p>
                <?php

                require_once("../model/level.php");

                $levels = Level::loadLevels();
                $ris = "<div class='row'>";
                for ($i = 0; $i < count($levels); $i++) {
                    $name = $levels[$i]->name;
                    $id = $levels[$i]->id;
                    $ris = $ris . "<button type='button' onclick='setLevel(".$id.")' id = '" . $id . "'>" . $name . "</button>";
                }
                $ris = $ris . "</div></div></div>";
                echo $ris


                    ?>
            </div>
            <div class="row">
                <p>Notes</p>
                <input placeholder="Notes..." oninput="this.className = ''" name="note">
            </div>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="nextBtn" onclick="checkEvent()">Submit</button>
            </div>
        </div>
    </form>
</body>
<script>
     const userId = '<?php echo $_SESSION["userID"] ?>'
     console.log('The user id is', userId)
  </script>
  <script src="../js/create_post.js"></script>

</html>