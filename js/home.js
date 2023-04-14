let prevPage = 0;
var home = document.querySelector('#home > a');
var profile = document.querySelector('#profile > a');
var settings = document.querySelector('#settings > a');
var request = document.querySelector('#request > a');
var your_request = document.querySelector('#your_request > a');

var homeIcon = document.querySelector('#home > svg > g > path');
var profileIcon = document.querySelector('#profile > svg > g > path');
var settingsIcon = document.querySelector('#settings > svg > g > path');
var requestIcon = document.querySelector('#request > svg > path');
var your_requestIcon = document.querySelector('#your_request > svg > path');


document.querySelector('.request-container').style.display = "none";
document.querySelector('.your-request-container').style.display = "none";
document.querySelector('.profile').style.display = "none";


let pagesLink = [home, profile, settings, request, your_request];
let pagesIcon = [homeIcon, profileIcon, settingsIcon, requestIcon, your_requestIcon];

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
            alert("Request sent")
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
        document.querySelector('.event-container').style.display = "none";
        document.querySelector('.your-request-container').style.display = "none";
        document.querySelector('.request-container').style.display = "none";
        document.querySelector('.profile').style.display = "none";

        if(prevPage == 1){
            document.querySelector('#profile path:nth-of-type(2)').style.fill = "white";
        } 
        if(prevPage == 2){
            document.querySelector('#settings path:nth-of-type(2)').style.fill = "white";
        }
        if(button == 1){
            document.querySelector('.profile').style.display = "block";
            document.querySelector('#profile path:nth-of-type(2)').style.fill = "#38B138";
        }
        if(button == 2) {
            document.querySelector('#settings path:nth-of-type(2)').style.fill = "#38B138";
        }
        if(button == 3){
            document.querySelector('.request-container').style.display = "block";
        }
        if(button == 0){
            document.querySelector('.event-container').style.display = "block";

        }
        if(button == 4){
            document.querySelector('.your-request-container').style.display = "block";
        }
        prevPage = button;
    }
    // document.getElementById(id).style.color = '#38B138';
    // // hide the lorem ipsum text
    // document.getElementById(text).style.display = 'none';
    // // hide the link
    // btn.style.display = 'none';

}

function handleRequest(request_id, user_id, action){
    let formData = new FormData();
    formData.append("id", request_id);
    formData.append("new_state", action);
    console.log()
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/update_request.php");
  
    xhttp.onreadystatechange = async function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "1") {
            location.reload();
        } else {
          alert(this.responseText);
        }
      }
    };
  
    xhttp.send(formData);
  
    if(action == 1){
        alert("Accepted");
    } else {

        alert("Refused");
    }
}