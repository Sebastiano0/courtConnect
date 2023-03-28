let level = -1;

function setLevel(id){
  var currentdate = new Date();

    level = id;
    console.log((currentdate.getHours() + ":" + currentdate.getMinutes()).toString());
}

function checkEvent(){
      createEvent();
}


function createEvent(){
  var currentdate = new Date();
  let time = document.forms["regForm"]["date"].value.split("T");
  let date = time[0];
  let hour = time[1];
  let sport = document.getElementById("dropdown").selectedIndex + 1;
  let creator_id = userId;
  let notes = document.forms["regForm"]["note"].value;
  let required_level = level;
  //let ad_typo = document.forms["regForm"]["ad_typo"].value;
  let address = document.forms["regForm"]["location"].value;
  let max_age = document.forms["regForm"]["ma-age"].value;
  let min_age = document.forms["regForm"]["mi-age"].value;
  let insert_date = currentdate.getFullYear() + "-" + (currentdate.getMonth()+1)  + "-" + currentdate.getDate();
  let insert_hour = (currentdate.getHours() + ":" + currentdate.getMinutes()).toString();

  let formData = new FormData();
  formData.append("date", date);
  formData.append("hour", hour);
  formData.append("sport", sport);
  formData.append("creator_id", creator_id);
  formData.append("notes", notes);
  formData.append("required_level", required_level);
  formData.append("ad_typo", 1);
  formData.append("address", address);
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
