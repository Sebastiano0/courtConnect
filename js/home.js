let prevPage = 0;
var home = document.querySelector('#home > a');
var profile = document.querySelector('#profile > a');
var settings = document.querySelector('#settings > a');
var request = document.querySelector('#request > a');
var homeIcon = document.querySelector('#home > svg > g > path');
var profileIcon = document.querySelector('#profile > svg > g > path');
var settingsIcon = document.querySelector('#settings > svg > g > path');
var requestIcon = document.querySelector('#request > svg > path');

let pagesLink = [home, profile, settings, request];
let pagesIcon = [homeIcon, profileIcon, settingsIcon, requestIcon]
function makeRequest(event, user_id) {
    console.log(event);
    console.log(user_id);

    let formData = new FormData();
    formData.append("event_id", event);
    formData.append("user_id", user_id);
    formData.append("state", 2);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/insert_request.php");
    xhttp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "1") {
            } else {
                console.log(this.responseText);
            }
        }
};

    xhttp.send(formData);
}

function changeScreen(button){
    if(prevPage == button){
        return;
    } else {
        pagesLink[button].style.color = '#38B138';
        pagesIcon[button].style.fill = '#38B138';
        pagesLink[prevPage].style.color = 'white';
        pagesIcon[prevPage].style.fill = 'white';
        prevPage = button;
    }
    // console.log(button);
    // document.getElementById(id).style.color = '#38B138';
    // // hide the lorem ipsum text
    // document.getElementById(text).style.display = 'none';
    // // hide the link
    // btn.style.display = 'none';

}