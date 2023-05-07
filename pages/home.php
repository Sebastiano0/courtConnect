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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../styles/home.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


</head>

<body onload="initMap()">
    <img class="logo" src="../assets/images/logo.svg" alt="logo">
    <button class="button" id="logout-button" onclick="logoutUser()">Logout</button>
    <?php
    echo '<div id="event"></div>';
    //load events as marker to the map
    ?>
    <?php
    require_once("../model/request.php");
    require_once("../model/event.php");
    require_once("../model/user.php");
    require_once("../model/level.php");
    require_once("../model/activity.php");

    $requests = Request::loadRequestsCompleted($_SESSION["userID"]);
    $ris = "";
    for ($i = 0; $i < count($requests); $i++) {
        $user = User::getUserById($requests[$i]->user_id);
        $event = Event::getEventById($requests[$i]->event_id);
        $lvl = Level::getLevelById($event->required_level);
        $activity = Activity::getActivitiesById($event->sport);
        $id = $requests[$i]->id;
        $ris = $ris . "<div id='" . $i . "' class='request-view'>" .
            "<div class='request-creator'>" . $user->name . " " . $user->surname . "</div>" .
            "<p> Requested to partecipate to your event<br></p>" .
            "<div class='request-properties'> " .
            "<p>(" . $activity->name . ", age " .  $event->min_age . "-" . $event->max_age . " " . $event->date . " " . $event->hour . " " . $event->lat . " " . $event->lat . " " . $lvl->name . ")</p>" .


            "<button id='acceptbutton' onclick='handleRequest(" . $id . "," . $_SESSION["userID"] . ", 1)'>Accept</button>" .
            "<button id='refusebutton' onclick='handleRequest(" . $id . "," . $_SESSION["userID"] . ", 3)'>Refuse</button>" .
            "</div></div>";
    }
    echo $ris;
    ?>

    <?php
    require_once("../model/request.php");

    $requests = Request::loadYourRequestsCompleted($_SESSION["userID"]);
    $ris = "";
    for ($i = 0; $i < count($requests); $i++) {

        $ris = $ris . "<div id='" . $requests[$i][7] . "' class='your-request-view'>" .
            "<p class='request-notes'><br><br>" . $requests[$i][8] . "</p>" .

            "<p class='request-properties'>" . $requests[$i][1] . " " . $requests[$i][2] . " " . $requests[$i][3] . " " . $requests[$i][6] . " " . $requests[$i][9] . "</p>" .

            "<p class='request-creator'>" . $requests[$i][4] . " " . $requests[$i][5] . " - " . $requests[$i][0] . "</p>" .

            "</div>";
    }
    echo $ris;
    ?>



    <div class="menu">
        <div id="home">
            <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_102_31)">
                    <path d="M28.9013 12.092L19.42 1.97734C18.2466 0.729324 16.6571 0.0285034 15 0.0285034C13.3429 0.0285034 11.7535 0.729324 10.58 1.97734L1.09877 12.092C0.749297 12.4624 0.472227 12.9031 0.283618 13.3885C0.095009 13.874 -0.001388 14.3945 1.50994e-05 14.92V28.0093C1.50994e-05 29.0702 0.395103 30.0876 1.09836 30.8378C1.80163 31.5879 2.75545 32.0093 3.75002 32.0093H26.25C27.2446 32.0093 28.1984 31.5879 28.9017 30.8378C29.6049 30.0876 30 29.0702 30 28.0093V14.92C30.0014 14.3945 29.905 13.874 29.7164 13.3885C29.5278 12.9031 29.2507 12.4624 28.9013 12.092ZM18.75 29.3427H11.25V24.0973C11.25 23.0365 11.6451 22.0191 12.3484 21.2689C13.0516 20.5188 14.0055 20.0973 15 20.0973C15.9946 20.0973 16.9484 20.5188 17.6517 21.2689C18.3549 22.0191 18.75 23.0365 18.75 24.0973V29.3427ZM27.5 28.0093C27.5 28.363 27.3683 28.7021 27.1339 28.9521C26.8995 29.2022 26.5815 29.3427 26.25 29.3427H21.25V24.0973C21.25 22.3292 20.5915 20.6335 19.4194 19.3833C18.2473 18.1331 16.6576 17.4307 15 17.4307C13.3424 17.4307 11.7527 18.1331 10.5806 19.3833C9.4085 20.6335 8.75002 22.3292 8.75002 24.0973V29.3427H3.75002C3.41849 29.3427 3.10055 29.2022 2.86613 28.9521C2.63171 28.7021 2.50002 28.363 2.50002 28.0093V14.92C2.50117 14.5666 2.63275 14.228 2.86627 13.9773L12.3475 3.86667C13.0521 3.11858 14.0058 2.6986 15 2.6986C15.9942 2.6986 16.9479 3.11858 17.6525 3.86667L27.1338 13.9813C27.3664 14.231 27.4979 14.568 27.5 14.92V28.0093Z" fill="#38B138" />
                </g>
                <defs>
                    <clipPath id="clip0_102_31">
                        <rect width="30" height="32" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <a class="pages" href="#" onclick="changeScreen(0);"> Home</a>
        </div>
        <div id="profile">
            <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_102_33)">
                    <path d="M15 16C16.4834 16 17.9334 15.5308 19.1668 14.6518C20.4001 13.7727 21.3614 12.5233 21.9291 11.0615C22.4968 9.59966 22.6453 7.99113 22.3559 6.43928C22.0665 4.88743 21.3522 3.46197 20.3033 2.34315C19.2544 1.22433 17.918 0.462403 16.4632 0.153721C15.0083 -0.15496 13.5003 0.00346629 12.1299 0.608967C10.7594 1.21447 9.58809 2.23985 8.76398 3.55544C7.93987 4.87104 7.5 6.41775 7.5 8C7.50199 10.1211 8.2928 12.1547 9.69889 13.6545C11.105 15.1544 13.0115 15.9979 15 16ZM15 2.66667C15.9889 2.66667 16.9556 2.97947 17.7779 3.5655C18.6001 4.15153 19.241 4.98449 19.6194 5.95903C19.9978 6.93357 20.0969 8.00592 19.9039 9.04049C19.711 10.0751 19.2348 11.0254 18.5355 11.7712C17.8363 12.5171 16.9454 13.0251 15.9755 13.2309C15.0055 13.4366 14.0002 13.331 13.0866 12.9274C12.173 12.5237 11.3921 11.8401 10.8427 10.963C10.2932 10.086 10 9.05484 10 8C10 6.58552 10.5268 5.22896 11.4645 4.22877C12.4021 3.22857 13.6739 2.66667 15 2.66667Z" fill="white" />
                    <path d="M15 18.6666C12.0173 18.6702 9.15777 19.9356 7.0487 22.1852C4.93964 24.4349 3.75331 27.4851 3.75 30.6666C3.75 31.0202 3.8817 31.3594 4.11612 31.6094C4.35054 31.8595 4.66848 32 5 32C5.33152 32 5.64946 31.8595 5.88388 31.6094C6.1183 31.3594 6.25 31.0202 6.25 30.6666C6.25 28.1913 7.17187 25.8173 8.81282 24.067C10.4538 22.3166 12.6794 21.3333 15 21.3333C17.3206 21.3333 19.5462 22.3166 21.1872 24.067C22.8281 25.8173 23.75 28.1913 23.75 30.6666C23.75 31.0202 23.8817 31.3594 24.1161 31.6094C24.3505 31.8595 24.6685 32 25 32C25.3315 32 25.6495 31.8595 25.8839 31.6094C26.1183 31.3594 26.25 31.0202 26.25 30.6666C26.2467 27.4851 25.0604 24.4349 22.9513 22.1852C20.8422 19.9356 17.9827 18.6702 15 18.6666Z" fill="white" />
                </g>
                <defs>
                    <clipPath id="clip0_102_33">
                        <rect width="30" height="32" fill="white" />
                    </clipPath>
                </defs>
            </svg>

            <a class="pages" href="#" onclick="changeScreen(1);"> Profile</a>
        </div>
        <div id="settings">
            <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_102_38)">
                    <path d="M15 10.6666C14.0111 10.6666 13.0444 10.9794 12.2222 11.5655C11.3999 12.1515 10.759 12.9844 10.3806 13.959C10.0022 14.9335 9.90315 16.0059 10.0961 17.0404C10.289 18.075 10.7652 19.0253 11.4645 19.7712C12.1637 20.5171 13.0546 21.025 14.0246 21.2308C14.9945 21.4366 15.9998 21.331 16.9134 20.9273C17.8271 20.5236 18.6079 19.8401 19.1574 18.963C19.7068 18.0859 20 17.0548 20 16C20 14.5855 19.4732 13.2289 18.5355 12.2287C17.5979 11.2285 16.3261 10.6666 15 10.6666ZM15 18.6666C14.5055 18.6666 14.0222 18.5102 13.6111 18.2172C13.2 17.9242 12.8795 17.5077 12.6903 17.0204C12.5011 16.5332 12.4516 15.997 12.548 15.4797C12.6445 14.9624 12.8826 14.4873 13.2322 14.1143C13.5819 13.7414 14.0273 13.4874 14.5123 13.3845C14.9972 13.2816 15.4999 13.3344 15.9567 13.5363C16.4135 13.7381 16.804 14.0799 17.0787 14.5184C17.3534 14.957 17.5 15.4725 17.5 16C17.5 16.7072 17.2366 17.3855 16.7678 17.8856C16.2989 18.3857 15.663 18.6666 15 18.6666Z" fill="white" />
                    <path d="M26.6175 18.5333L26.0625 18.192C26.3124 16.7419 26.3124 15.2554 26.0625 13.8053L26.6175 13.464C27.0443 13.2014 27.4184 12.8516 27.7185 12.4347C28.0186 12.0179 28.2387 11.5421 28.3664 11.0344C28.4941 10.5268 28.5268 9.99732 28.4626 9.47621C28.3985 8.95511 28.2387 8.45258 27.9925 7.99733C27.7463 7.54208 27.4184 7.14302 27.0276 6.82294C26.6368 6.50285 26.1907 6.26801 25.7148 6.13182C25.2389 5.99562 24.7425 5.96075 24.2539 6.02918C23.7654 6.09762 23.2943 6.26802 22.8675 6.53067L22.3112 6.87333C21.2607 5.91589 20.0533 5.17366 18.75 4.684V4C18.75 2.93913 18.3549 1.92172 17.6516 1.17157C16.9484 0.421427 15.9946 0 15 0C14.0054 0 13.0516 0.421427 12.3483 1.17157C11.6451 1.92172 11.25 2.93913 11.25 4V4.684C9.94673 5.17542 8.7398 5.91947 7.68999 6.87867L7.13124 6.53333C6.26929 6.0029 5.24509 5.85943 4.28397 6.13448C3.32285 6.40954 2.50352 7.08058 2.00624 8C1.50896 8.91942 1.37446 10.0119 1.63232 11.0371C1.89018 12.0623 2.51929 12.9362 3.38124 13.4667L3.93624 13.808C3.68638 15.2581 3.68638 16.7446 3.93624 18.1947L3.38124 18.536C2.51929 19.0664 1.89018 19.9404 1.63232 20.9656C1.37446 21.9908 1.50896 23.0833 2.00624 24.0027C2.50352 24.9221 3.32285 25.5931 4.28397 25.8682C5.24509 26.1432 6.26929 25.9998 7.13124 25.4693L7.68749 25.1267C8.73845 26.0842 9.94622 26.8265 11.25 27.316V28C11.25 29.0609 11.6451 30.0783 12.3483 30.8284C13.0516 31.5786 14.0054 32 15 32C15.9946 32 16.9484 31.5786 17.6516 30.8284C18.3549 30.0783 18.75 29.0609 18.75 28V27.316C20.0533 26.8246 21.2602 26.0805 22.31 25.1213L22.8687 25.4653C23.7307 25.9958 24.7549 26.1392 25.716 25.8642C26.6771 25.5891 27.4965 24.9181 27.9937 23.9987C28.491 23.0793 28.6255 21.9868 28.3677 20.9616C28.1098 19.9364 27.4807 19.0624 26.6187 18.532L26.6175 18.5333ZM23.4325 13.4987C23.8558 15.1348 23.8558 16.8626 23.4325 18.4987C23.3586 18.7834 23.3754 19.0863 23.4804 19.3597C23.5854 19.6332 23.7726 19.8617 24.0125 20.0093L25.3675 20.844C25.6548 21.0208 25.8644 21.3121 25.9503 21.6538C26.0362 21.9955 25.9914 22.3596 25.8256 22.666C25.6599 22.9724 25.3868 23.196 25.0664 23.2877C24.7461 23.3793 24.4048 23.3315 24.1175 23.1547L22.76 22.3173C22.5199 22.169 22.2403 22.1101 21.9653 22.1499C21.6903 22.1897 21.4356 22.326 21.2412 22.5373C20.1286 23.7489 18.727 24.6133 17.1875 25.0373C16.9188 25.111 16.6807 25.278 16.5107 25.5119C16.3408 25.7458 16.2486 26.0334 16.2487 26.3293V28C16.2487 28.3536 16.117 28.6928 15.8826 28.9428C15.6482 29.1929 15.3303 29.3333 14.9987 29.3333C14.6672 29.3333 14.3493 29.1929 14.1149 28.9428C13.8804 28.6928 13.7487 28.3536 13.7487 28V26.3307C13.7489 26.0347 13.6567 25.7471 13.4867 25.5132C13.3168 25.2793 13.0787 25.1124 12.81 25.0387C11.2704 24.6129 9.86915 23.7466 8.75749 22.5333C8.56315 22.322 8.30841 22.1857 8.03344 22.1459C7.75846 22.1061 7.47887 22.165 7.23874 22.3133L5.88374 23.1493C5.74153 23.2383 5.58423 23.2963 5.4209 23.3201C5.25757 23.344 5.09143 23.3331 4.93206 23.2881C4.77269 23.2432 4.62322 23.1651 4.49227 23.0582C4.36132 22.9514 4.25146 22.8181 4.16904 22.6658C4.08661 22.5135 4.03324 22.3453 4.01199 22.1709C3.99074 21.9966 4.00204 21.8194 4.04523 21.6497C4.08842 21.48 4.16266 21.3211 4.26366 21.1822C4.36466 21.0432 4.49044 20.9269 4.63374 20.84L5.98874 20.0053C6.22868 19.8577 6.41584 19.6292 6.52082 19.3557C6.6258 19.0823 6.64266 18.7794 6.56874 18.4947C6.14544 16.8586 6.14544 15.1308 6.56874 13.4947C6.64133 13.2105 6.62366 12.9087 6.51851 12.6364C6.41336 12.3641 6.22664 12.1365 5.98749 11.9893L4.63249 11.1547C4.34523 10.9779 4.13558 10.6866 4.04967 10.3449C3.96375 10.0032 4.00861 9.63908 4.17437 9.33267C4.34013 9.02625 4.61321 8.80263 4.93355 8.71099C5.25388 8.61934 5.59523 8.66719 5.88249 8.844L7.23999 9.68133C7.47947 9.83002 7.75847 9.88962 8.03315 9.85076C8.30784 9.8119 8.56263 9.67679 8.75749 9.46667C9.8701 8.25512 11.2718 7.39069 12.8112 6.96667C13.0808 6.89275 13.3195 6.725 13.4895 6.49C13.6596 6.255 13.7512 5.96619 13.75 5.66933V4C13.75 3.64638 13.8817 3.30724 14.1161 3.05719C14.3505 2.80714 14.6685 2.66667 15 2.66667C15.3315 2.66667 15.6495 2.80714 15.8839 3.05719C16.1183 3.30724 16.25 3.64638 16.25 4V5.66933C16.2499 5.96528 16.342 6.25286 16.512 6.48677C16.6819 6.72069 16.92 6.88764 17.1887 6.96133C18.7288 7.38687 20.1305 8.25318 21.2425 9.46667C21.4368 9.67796 21.6916 9.81426 21.9665 9.85409C22.2415 9.89392 22.5211 9.83502 22.7612 9.68667L24.1162 8.85067C24.2585 8.76174 24.4158 8.70369 24.5791 8.67987C24.7424 8.65605 24.9086 8.66692 25.0679 8.71187C25.2273 8.75681 25.3768 8.83494 25.5077 8.94175C25.6387 9.04856 25.7485 9.18195 25.8309 9.33423C25.9134 9.48651 25.9667 9.65468 25.988 9.82905C26.0092 10.0034 25.9979 10.1806 25.9548 10.3503C25.9116 10.52 25.8373 10.6789 25.7363 10.8178C25.6353 10.9568 25.5096 11.0731 25.3662 11.16L24.0112 11.9947C23.7726 12.1423 23.5864 12.37 23.4817 12.6423C23.377 12.9145 23.3597 13.2161 23.4325 13.5V13.4987Z" fill="white" />
                </g>
                <defs>
                    <clipPath id="clip0_102_38">
                        <rect width="30" height="32" fill="white" />
                    </clipPath>
                </defs>
            </svg>

            <a class="pages" href="#" onclick="changeScreen(2);"> Settings</a>
        </div>
    </div>
    <button class="button" type="button" id="create-post" onclick="window.location.href = './create.php'">Create
        post</button>

    <div class="requests">
        <div id="request">

            <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.1667 0H5.83333C4.28681 0.00194873 2.80415 0.649083 1.71059 1.79945C0.617029 2.94982 0.0018525 4.5095 0 6.13636L0 20.8636C0.0018525 22.4905 0.617029 24.0502 1.71059 25.2006C2.80415 26.3509 4.28681 26.9981 5.83333 27H22.1667C23.7132 26.9981 25.1959 26.3509 26.2894 25.2006C27.383 24.0502 27.9981 22.4905 28 20.8636V6.13636C27.9981 4.5095 27.383 2.94982 26.2894 1.79945C25.1959 0.649083 23.7132 0.00194873 22.1667 0ZM5.83333 2.45455H22.1667C22.8652 2.45599 23.5474 2.67731 24.1254 3.09003C24.7035 3.50275 25.1508 4.08798 25.41 4.77041L16.4757 14.1701C15.8182 14.859 14.928 15.2458 14 15.2458C13.072 15.2458 12.1818 14.859 11.5243 14.1701L2.59 4.77041C2.84917 4.08798 3.29655 3.50275 3.87456 3.09003C4.45256 2.67731 5.13475 2.45599 5.83333 2.45455ZM22.1667 24.5455H5.83333C4.90508 24.5455 4.01484 24.1576 3.35846 23.4671C2.70208 22.7766 2.33333 21.8401 2.33333 20.8636V7.97727L9.87467 15.9055C10.9697 17.0545 12.4533 17.6998 14 17.6998C15.5467 17.6998 17.0303 17.0545 18.1253 15.9055L25.6667 7.97727V20.8636C25.6667 21.8401 25.2979 22.7766 24.6415 23.4671C23.9852 24.1576 23.0949 24.5455 22.1667 24.5455Z" fill="white" />
            </svg>

            <a class="pages" href="#" onclick="changeScreen(3);"><br>Request</a>
        </div>

        <?php
        require_once("../model/request.php");

        $requests = Request::loadRequests($_SESSION["userID"]);
        $ris = "";
        for ($i = 0; $i < count($requests); $i++) {
            $name = $requests[$i][0];
            $surname = $requests[$i][1];
            $ris = $ris . "<div id='" . $i . "' class='request'>" .
                "<p class='name-request'>" . $name . " " . $surname . "</p></div>";
            //$ris = $ris . "<div>" . $activity . $user->name. "</div>";
        }
        echo $ris;
        ?>
    </div>

    <div id="your_requests_parent">
        <div id="your_request">

            <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.1667 0H5.83333C4.28681 0.00194873 2.80415 0.649083 1.71059 1.79945C0.617029 2.94982 0.0018525 4.5095 0 6.13636L0 20.8636C0.0018525 22.4905 0.617029 24.0502 1.71059 25.2006C2.80415 26.3509 4.28681 26.9981 5.83333 27H22.1667C23.7132 26.9981 25.1959 26.3509 26.2894 25.2006C27.383 24.0502 27.9981 22.4905 28 20.8636V6.13636C27.9981 4.5095 27.383 2.94982 26.2894 1.79945C25.1959 0.649083 23.7132 0.00194873 22.1667 0ZM5.83333 2.45455H22.1667C22.8652 2.45599 23.5474 2.67731 24.1254 3.09003C24.7035 3.50275 25.1508 4.08798 25.41 4.77041L16.4757 14.1701C15.8182 14.859 14.928 15.2458 14 15.2458C13.072 15.2458 12.1818 14.859 11.5243 14.1701L2.59 4.77041C2.84917 4.08798 3.29655 3.50275 3.87456 3.09003C4.45256 2.67731 5.13475 2.45599 5.83333 2.45455ZM22.1667 24.5455H5.83333C4.90508 24.5455 4.01484 24.1576 3.35846 23.4671C2.70208 22.7766 2.33333 21.8401 2.33333 20.8636V7.97727L9.87467 15.9055C10.9697 17.0545 12.4533 17.6998 14 17.6998C15.5467 17.6998 17.0303 17.0545 18.1253 15.9055L25.6667 7.97727V20.8636C25.6667 21.8401 25.2979 22.7766 24.6415 23.4671C23.9852 24.1576 23.0949 24.5455 22.1667 24.5455Z" fill="white" />
            </svg>

            <a class="pages" href="#" onclick="changeScreen(4);"><br> Your request</a>
        </div>

        <?php
        require_once("../model/request.php");
        require_once("../model/activity.php");
        $requests = Request::loadYourRequests($_SESSION["userID"]);
        $ris = "";
        for ($i = 0; $i < count($requests); $i++) {
            $state = $requests[$i][0];
            $activity = Activity::getActivitiesById($requests[$i][1]);
            $date = $requests[$i][2];
            $hour = $requests[$i][3];
            $ris = $ris . "<div id='" . $i . "' class='your-request'>" .
                "<p class='name-your_request'><b>" . $activity->name . "</b> " . $date . " " . $state . "</p></div>";
        }
        echo $ris;
        ?>
    </div>

    <div class="profile profile-container">
        <?php
        require_once("../model/activity.php");
        require_once("../model/user.php");
        $userId = $_SESSION["userID"];
        $user = User::getUserById($userId);
        $name = $user->name;
        $surname = $user->surname;
        $email = $user->email;
        $password = $user->password;
        $birth_date = $user->birth_date;
        $phone = $user->phone;
        $tax_id = $user->taxId;        
        $loadProfile = "<h1>Il tuo profilo</h1><br>";
        $loadProfile = $loadProfile . "<label>Nome: $name</label><br>";
        $loadProfile = $loadProfile . "<label>Cognome:  $surname <br>";
        $loadProfile = $loadProfile . "<label>Email:  $email <br>";
        $loadProfile = $loadProfile . "<label>Birth date:  $birth_date <br>";
        $loadProfile = $loadProfile . "<label>Phone:  $phone <br>";
        $loadProfile = $loadProfile . "<label>Tax id:  $tax_id <br>";


        // $loadProfile = $loadProfile . "<label>Password: </label><input type='text' id='password' value='" . $password . "'><br>";
        // $loadProfile = $loadProfile . "<button type='button' id='prova' onclick='updateProfile(" . $userId . ")'>Aggiorna</button>";
        echo $loadProfile;

        $activities = Activity::loadActivities();
        $loadActivities = "<h1>Aggiungi Attività</h1><br>";
        for ($i = 0; $i < count($activities); $i++) {
            $name = $activities[$i]->name;
            $id = $activities[$i]->id;
            $loadActivities = $loadActivities . "<label><input type='checkbox' name='sport[]' value='" . $id . "'>" . $name . "</label>";
        }
        $loadActivities = $loadActivities . "<button type='button' id='prova' onclick='addPreferences( " . $userId . ")'>Aggiungi ai preferiti</button>";
        echo $loadActivities;

        require_once("../model/user_preferences.php");
        $requests = UserPreference::loadUserPreferences($userId);
        $loadUserPreferences = "<h1>Le attività preferite</h1><br>";
        for ($i =  0; $i < count($requests); $i++) {
            $activity = Activity::getActivitiesById($requests[$i]->activity_id);
            $loadUserPreferences = $loadUserPreferences . "<div id='" . $i . "' class='your-activities'>" .
                "<p class='name-your_activities'>" . $activity->name . " </p></div>";
        }
        echo $loadUserPreferences;
        ?>
    </div>


</body>
<script>
    // Seleziona tutti gli elementi con classe "event"
    const eventElements = document.querySelectorAll('#event');
    const requestElements = document.querySelectorAll('.request-view');
    const yourRequestElements = document.querySelectorAll('.your-request-view');
    // Aggiungi uno stile personalizzato per gli elementi "event"
    const style = document.createElement('style');
    style.textContent = `
    .event-container, .request-container, .your-request-container{
        position: relative;
        width: 60%;
        height: 80%;
        top: 20%;
        left: 20%;
        overflow-y: scroll;
    }    
    
    .event, .request-view, .your-request-view{
    position: absolute;
    width: 27%;
    height: 57.03%;
    background: #666666;
    border-radius: 35px;
    top: calc((57.03% + 10.05%) * (int)var(--post-index)/3);
    padding-right: 20px;
    }
`;
    document.head.appendChild(style);

    // Crea un contenitore per gli elementi "event"
    const container = document.createElement('div');
    container.classList.add('event-container');
    const r_container = document.createElement('div');
    r_container.classList.add('request-container');
    const y_r_container = document.createElement('div');
    y_r_container.classList.add('your-request-container');

    // Aggiungi gli elementi "event" al contenitore
    eventElements.forEach((eventElement, index) => {
        eventElement.style.setProperty('--post-index', index);
        container.appendChild(eventElement);
    });

    requestElements.forEach((requestElements, index) => {
        requestElements.style.setProperty('--post-index', index);
        r_container.appendChild(requestElements);
    });

    yourRequestElements.forEach((yourRequestElements, index) => {
        yourRequestElements.style.setProperty('--post-index', index);
        y_r_container.appendChild(yourRequestElements);
    });

    // Aggiungi il contenitore alla pagina
    document.body.appendChild(container);
    document.body.appendChild(r_container);
    document.body.appendChild(y_r_container);
</script>
<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyCEIyEKkspLepmlsDKS_q5xlA7tPVnoY6U", v: "weekly"});</script>

<script type="text/javascript" src="../js/home.js"></script>
</html>