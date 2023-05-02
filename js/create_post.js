let level = -1;
let inserted_latitude = 0;
let inserted_longitude = 0;

function setLevel(id) {
  if (level != -1) {
  prevButton = document.getElementById(level);
  prevButton.style.backgroundColor = "transparent";
  }
  level = id;
  var levelButton = document.getElementById(id);
  levelButton.style.backgroundColor = "#38B138";
}

function checkEvent() {
  createEvent();
}


function createEvent() {
  var currentdate = new Date();
  let time = document.forms["regForm"]["date"].value.split("T");
  let date = time[0];
  let hour = time[1];
  let sport = document.getElementById("dropdown").selectedIndex + 1;
  let creator_id = userId;
  let notes = document.forms["regForm"]["note"].value;
  let required_level = level;
  //let ad_typo = document.forms["regForm"]["ad_typo"].value;
  let max_age = document.forms["regForm"]["ma-age"].value;
  let min_age = document.forms["regForm"]["mi-age"].value;
  let insert_date = currentdate.getFullYear() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getDate();
  let insert_hour = (currentdate.getHours() + ":" + currentdate.getMinutes()).toString();

  let formData = new FormData();
  formData.append("date", date);
  formData.append("hour", hour);
  formData.append("sport", sport);
  formData.append("creator_id", creator_id);
  formData.append("notes", notes);
  formData.append("required_level", required_level);
  formData.append("ad_typo", 1);
  formData.append("lat", inserted_latitude);
  formData.append("lng", inserted_longitude);
  formData.append("max_age", max_age);
  formData.append("min_age", min_age);
  formData.append("insert_date", insert_date);
  formData.append("insert_hour", insert_hour);

  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../api/insert_event.php");

  xhttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "1") {
        alert("L'evento è stato inserito correttamente");
        window.location.href = "../pages/home.php";
      } else {
        alert(this.responseText);
      }
    }
  };

  xhttp.send(formData);
}

$(function () {

  $('#location').locationpicker({
    location: { latitude: 46.15242437752303, longitude: 2.7470703125 },
    radius: 0,
    inputBinding: {
      latitudeInput: $('#lat'),
      longitudeInput: $('#lng'),
      locationNameInput: $('#location')
    },
    enableAutocomplete: true,
    onchanged: function (currentLocation, radius, isMarkerDropped) {
      inserted_longitude = currentLocation.longitude;
      inserted_latitude = currentLocation.latitude;
      // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
    }
  });

});
