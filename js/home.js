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

function makeRequest(event) {
  let formData = new FormData();
  formData.append("event_id", event);
  formData.append("user_id", userID);
  formData.append("state", 1);

  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../api/insert_request.php");
  xhttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      showSnackbar("Request sent");

      if (this.responseText == "1") {
      } else {
        console.log(this.responseText);
      }
    }
  };

  xhttp.send(formData);
}

function changeScreen(button) {
  if (prevPage == button) {
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

    if (prevPage == 1) {
      document.querySelector('#profile path:nth-of-type(2)').style.fill = "white";
    }
    if (prevPage == 2) {
      document.querySelector('#settings path:nth-of-type(2)').style.fill = "white";
    }
    if (button == 1) {
      document.querySelector('.profile').style.display = "block";
      document.querySelector('#profile path:nth-of-type(2)').style.fill = "#38B138";
    }
    if (button == 2) {
      document.querySelector('#settings path:nth-of-type(2)').style.fill = "#38B138";
    }
    if (button == 3) {
      document.querySelector('.request-container').style.display = "block";
    }
    if (button == 0) {
      document.querySelector('.event-container').style.display = "block";

    }
    if (button == 4) {
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

function handleRequest(request_id, action) {
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

  if (action == 2) {
    showSnackbar("Request accepted");

  } else {

    showSnackbar("Request declined");
  }
}


function showSnackbar(text) {
  var snackbar = document.createElement("div");
  snackbar.id = "snackbar";
  snackbar.innerHTML = text;
  document.body.appendChild(snackbar);
  snackbar.className = "show";
  setTimeout(function(){ 
    snackbar.className = snackbar.className.replace("show", ""); 
    document.body.removeChild(snackbar);
  }, 3000);
}


async function addPreferences(id) {
  var input = document.getElementsByName("sport[]");
  var ris = [];
  for (var i = 0; i < input.length; i++) {
    if (input[i].checked) {
      ris.push(input[i].value);
    }
  }
  try {
    console.log(`Ultimo ID utente inserito: ${id}`);
  } catch (error) {
    console.error(error);
  }

  for (var i = 0; i < ris.length; i++) {
    let formData = new FormData();
    formData.append("activity", ris[i]);
    formData.append("user", id);
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../api/insert_user_preferences.php");
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "1") {
          console.log("Inserted");
        } else {
          console.log(this.responseText);
        }
      }
    };
    xhttp.send(formData);
    console.log(ris);
  }
}

function logoutUser() {
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../api/logout_user.php");

  xhttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "1") {
        location.reload();
      } else {
        alert("Some error occured");
      }
    }
  };

  xhttp.send();
}

let map;

function getLocation() {
  latitude = 0;
  longitude = 0;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;
        map.setCenter({ lat: latitude, lng: longitude });
      }
    );
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

async function initMap() {
  getLocation();
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  map = new Map(document.getElementById("event"), {
    center: { lat: 0, lng: 0 },
    zoom: 14,
  });

  // Make an XMLHttpRequest to fetch data from the backend
  const xhr = new XMLHttpRequest();
  console.log(userID);
  xhr.open("GET", "../api/load_events.php?id=" + userID);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const events = JSON.parse(xhr.responseText);

      // Add markers to the map
      for (const event of events) {
        const location = { lat: parseFloat(event.lat), lng: parseFloat(event.lng) };
        const marker = addMarker(location);
        attachMarkerClickListener(marker, event);
      }
    }
  };
  xhr.send();
}

function addMarker(location) {
  const marker = new google.maps.Marker({
    position: location,
    map: map,
  });
  return marker;
}

function attachMarkerClickListener(marker, event) {
  const infowindow = new google.maps.InfoWindow({
    content: createInfoWindowContent(event),
  });

  marker.addListener("click", function () {
    infowindow.open(map, marker);
  });
}

function createInfoWindowContent(event) {
  const content = document.createElement("div");
  const sportName = getSport(event.sport);
  const sport = document.createElement("p");
  sport.innerHTML = "<strong>" + sportName + "</strong>";
  content.appendChild(sport);

  const notes = document.createElement("p");
  notes.innerHTML = event.notes;
  content.appendChild(notes);

  const dateTime = document.createElement("p");
  const formattedDateTime = formatDateTime(event.date, event.hour);
  dateTime.textContent = 'Date: ' + formattedDateTime;
  content.appendChild(dateTime);

  const learnMore = document.createElement("p");
  const link = document.createElement("a");
  link.href = "#";
  link.innerHTML = "Scopri di più";
  link.addEventListener("click", function () {
    openDetailsPage(event, sportName, formattedDateTime);
  });
  learnMore.appendChild(link);
  content.appendChild(learnMore);

  return content;
}



function formatDateTime(date, hour) {
  const eventDate = new Date(date);
  const formattedDate = eventDate.toLocaleDateString("en-US", {
    day: "2-digit",
    month: "2-digit",
    year: "numeric"
  });
  const formattedHour = hour.split(":").slice(0, 2).join(":");
  return formattedHour + " " + formattedDate;
}

async function openDetailsPage(event, sportName, formattedDateTime) {
  // Create a div with the info
  address = await getLocationName(event.lat, event.lng);
  creator = await getCreatorName(event.creator_id);
  level = await getLevelName(event.required_level);
  //TODO get event info from db
  const info = document.createElement("div");
  info.innerHTML = "<strong>" + event.notes + "</strong><br>" +
    "Date: " + formattedDateTime + "<br>" +
    "Sport: " + sportName + "<br>" +
    "Creator: " + creator + "<br>" +
    "Required Level: " + level + "<br>" +
    "Position: " + address + "<br>" +
    "Age: " + event.min_age + "-" + event.max_age + "<br>"
    + "<button onclick='makeRequest(" + event.id + ")'>Join</button>";

  // Append the info div to the document body
  document.body.appendChild(info);
}

async function getLocationName(lat, lng) {
  let address = "";
  const response = await fetch('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ',' + lng + '&key=AIzaSyCEIyEKkspLepmlsDKS_q5xlA7tPVnoY6U');
  const data = await response.json(); //extract JSON from the http response
  address = data.results[0].formatted_address;
  return address;
}

getCreatorName = async (creator_id) => {
  let creator = "";
  const response = await fetch('../api/load_user_by_id.php?id=' + creator_id);
  const data = await response.json(); //extract JSON from the http response
  creator = data.name + " " + data.surname;
  return creator;
}

getLevelName = async (level_id) => {
  let level = "";
  const response = await fetch('../api/load_level_by_id.php?id=' + level_id);
  const data = await response.json(); //extract JSON from the http response
  level = data.name;
  console.log(level);
  return level;
}

function getSport(sportID) {
  let sport = "";
  let xhr = new XMLHttpRequest();
  xhr.open("GET", '../api/load_activity_by_id.php?id=' + sportID, false);

  xhr.send();

  if (xhr.status === 200) {
    const response = JSON.parse(xhr.responseText);
    sport = response.name;
  } else {
    console.log(xhr.status);
  }

  return sport;
}

initMap();
