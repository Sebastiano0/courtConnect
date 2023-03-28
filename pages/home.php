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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <img class="logo" src="../assets/images/logo.svg" alt="logo">
    <button class="button" id="logout-button" onclick="window.location.href = '../index.php'">Logout</button>
    
        <?php
        require_once("../model/event.php");
        require_once("../model/user.php");
        require_once("../model/level.php");

        $events = Event::LoadEvents();
        $ris = "";
        for ($i = 0; $i < count($events); $i++) {
            $user = User::getUserById($events[$i]->creator_id);
            $lvl = Level::getLevelById($events[$i]->required_level);
            $activity = $events[$i]->sport;
            $id = $events[$i]->id;
            $ris = $ris . "<div id='" . $i . "' class='event'>" .
                "<div class='event-creator'>" . $user->name . " " . $user->surname . "</div>" .
                "<div class='event-date'>" . $events[$i]->insert_date . " " . $events[$i]->insert_hour . "</div>" .
                "<div class='event-properties'>" .
                "<a class='event-property'>" . $events[$i]->sport . "</a>" .
                "<a class='event-property'>" . $events[$i]->date . " " . $events[$i]->hour . "</a>" .
                "<a class='event-property'>" . $events[$i]->min_age . " " . $events[$i]->max_age . "</a>" .
                "<a class='event-property'>" . $lvl->name . "</a>" .
                "<a class='event-property'>" . $events[$i]->address . "</a>" .
                "</div>" .
                "<div class='event-note'>" . $events[$i]->notes . "</div>" .
                "<button>Request</button>" .
                "</div>";
            //$ris = $ris . "<div>" . $activity . $user->name. "</div>";
        }
        echo $ris;
        ?>


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
    <button class="button" id="create-post" onclick="window.location.href = './create.php'">Create post</button>
    <div class="requests"></div>
</body>
<script>
// Seleziona tutti gli elementi con classe "event"
const eventElements = document.querySelectorAll('.event');

// Aggiungi uno stile personalizzato per gli elementi "event"
const style = document.createElement('style');
style.textContent = `
	.event-container {
		position: relative;
		width: 100%;
		height: 80%;
        top: 20%;
		overflow-y: scroll;
	}
	.event {
		position: absolute;
		width: 60%;
		height: 57.03%;
		left: 20%;
		background: #666666;
		border-radius: 35px;
		top: calc(10.05% + (57.03% + 10.05%) * var(--post-index));
	}
`;
document.head.appendChild(style);

// Crea un contenitore per gli elementi "event"
const container = document.createElement('div');
container.classList.add('event-container');

// Aggiungi gli elementi "event" al contenitore
eventElements.forEach((eventElement, index) => {
	eventElement.style.setProperty('--post-index', index);
	container.appendChild(eventElement);
});

// Aggiungi il contenitore alla pagina
document.body.appendChild(container);
</script>

</html>