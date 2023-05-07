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
  formData.append("state", 1);

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

function handleRequest(request_id, user_id, action) {
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
    alert("Accepted");
  } else {

    alert("Refused");
  }
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
  xhr.open("GET", "../api/load_events.php");
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
  const sportName =  getSport(event.sport);
  console.log(event);
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
  learnMore.innerHTML = '<a href="#" onclick="openDetailsPage(\'' + event.id+ '\', \'' + sportName + '\', \'' + formattedDateTime + '\')">Scopri di più</a>';
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

function openDetailsPage(event, sportName, formattedDateTime) {
  // Create a div with the info
  console.log(event);
  //TODO get event info from db
  const info = document.createElement("div");
  info.innerHTML = "<strong>" + event + "</strong><br>" +
                   "Date: " + formattedDateTime + "<br>" +
                   "Sport: " + sportName + "<br>" +
                   "Creator: " + event.creator_id + "<br>" +
                   "Required Level: " + event.required_level + "<br>" +
                  //  "Latitude: " + event.$lat + "<br>" +
                  //  "Longitude: " + event.$lng + "<br>" +
                  //convert lng and lat in position
                    "Position: " + event.lat + " " + event.lng + "<br>" +

                   "Maximum Age: " + event.max_age + "<br>" +
                   "Minimum Age: " + event.min_age + "<br>";
  
  // Append the info div to the document body
  document.body.appendChild(info);
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

    return sport;  }

initMap();
