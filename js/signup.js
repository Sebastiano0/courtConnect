// Slider(all Slides in a container)
const slider = document.querySelector(".slider")
// All trails 
const trail = document.querySelector(".trail").querySelectorAll("div")

// Transform value
let value = 0
// trail index number
let trailValue = 0
// interval (Duration)
let interval = 4000

// Function to slide forward
const slide = (condition) => {
    // CLear interval
    clearInterval(start)
    // update value and trailValue
    condition === "increase" ? initiateINC() : initiateDEC()
    // move slide
    move(value, trailValue)
    // Restart Animation
    animate()
    // start interal for slides back 
    start = setInterval(() => slide("increase"), interval);
}

// function for increase(forward, next) configuration
const initiateINC = () => {
    // Remove active from all trails
    trail.forEach(cur => cur.classList.remove("active"))
    // increase transform value
    value === 80 ? value = 0 : value += 20
    // update trailValue based on value
    trailUpdate()
}

// function for decrease(backward, previous) configuration
const initiateDEC = () => {
     // Remove active from all trails
    trail.forEach(cur => cur.classList.remove("active"))
    // decrease transform value
    value === 0 ? value = 80 : value -= 20
     // update trailValue based on value
    trailUpdate()
}

// function to transform slide 
const move = (S, T) => {
    // transform slider
    slider.style.transform = `translateX(-${S}%)`
    //add active class to the current trail
    trail[T].classList.add("active")
}

const tl = gsap.timeline({defaults: {duration: 0.6, ease: "power2.inOut"}})
tl.from(".bg", {x: "-100%", opacity: 0})
  .from("p", {opacity: 0}, "-=0.3")
  .from("h1", {opacity: 0, y: "30px"}, "-=0.3")
  .from("button", {opacity: 0, y: "-40px"}, "-=0.8")

// function to restart animation
const animate = () => tl.restart()

// function to update trailValue based on slide value
const trailUpdate = () => {
    if (value === 0) {
        trailValue = 0
    } else if (value === 20) {
        trailValue = 1
    } else if (value === 40) {
        trailValue = 2
    } else if (value === 60) {
        trailValue = 3
    } else {
        trailValue = 4
    }
}   

// Start interval for slides
let start = setInterval(() => slide("increase"), interval)

// Next  and  Previous button function (SVG icon with different classes)
document.querySelectorAll("svg").forEach(cur => {
    // Assign function based on the class Name("next" and "prev")
    cur.addEventListener("click", () => cur.classList.contains("next") ? slide("increase") : slide("decrease"))
})

// function to slide when trail is clicked
const clickCheck = (e) => {
    // CLear interval
    clearInterval(start)
    // remove active class from all trails
    trail.forEach(cur => cur.classList.remove("active"))
    // Get selected trail
    const check = e.target
    // add active class
    check.classList.add("active")

    // Update slide value based on the selected trail
    if(check.classList.contains("box1")) {
        value = 0
    } else if (check.classList.contains("box2")) {
        value = 20
    } else if (check.classList.contains("box3")) {
        value = 40
    } else if (check.classList.contains("box4")) {
        value = 60
    } else {
        value = 80
    }
    // update trail based on value
    trailUpdate()
    // transfrom slide
    move(value, trailValue)
    // start animation
    animate()
    // start interval
    start = setInterval(() => slide("increase"), interval)
}

// Add function to all trails
trail.forEach(cur => cur.addEventListener("click", (ev) => clickCheck(ev)))

// Mobile touch Slide Section
const touchSlide = (() => {
    let start, move, change, sliderWidth

    // Do this on initial touch on screen
    slider.addEventListener("touchstart", (e) => {
        // get the touche position of X on the screen
        start = e.touches[0].clientX
        // (each slide with) the width of the slider container divided by the number of slides
        sliderWidth = slider.clientWidth/trail.length
    })
    
    // Do this on touchDrag on screen
    slider.addEventListener("touchmove", (e) => {
        // prevent default function
        e.preventDefault()
        // get the touche position of X on the screen when dragging stops
        move = e.touches[0].clientX
        // Subtract initial position from end position and save to change variabla
        change = start - move
    })

    const mobile = (e) => {
        // if change is greater than a quarter of sliderWidth, next else Do NOTHING
        change > (sliderWidth/4)  ? slide("increase") : null;
        // if change * -1 is greater than a quarter of sliderWidth, prev else Do NOTHING
        (change * -1) > (sliderWidth/4) ? slide("decrease") : null;
        // reset all variable to 0
        [start, move, change, sliderWidth] = [0,0,0,0]
    }
    // call mobile on touch end
    slider.addEventListener("touchend", mobile)
})()

/*
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:

  try {
    // se sono nel signup
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
  } catch (error) { }
  if (n == x.length - 1) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n);
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    //document.getElementById("regForm").submit();
    signup();
    var s = document.getElementById("regForm");
    console.log(s);
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x,
    y,
    i,
    valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:

  for (i = 0; i < y.length; i++) {
    y[i].classList.remove("invalid");
    var error = y[i].parentNode.querySelector(".invalid-feedback");
    if (error) {
      error.parentNode.removeChild(error);
    }

    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  switch (currentTab) {
    case 0:
      let fname = document.forms["regForm"]["fname"].value;
      if (!/^[A-Za-z]+$/.test(fname)) {
        document.forms["regForm"]["fname"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "This field is required.";
        document.forms["regForm"]["fname"].parentNode.appendChild(error);
        valid = false;
      }
      let lname = document.forms["regForm"]["lname"].value;
      if (!/^[A-Za-z]+$/.test(lname)) {
        document.forms["regForm"]["lname"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "This field is required.";
        document.forms["regForm"]["lname"].parentNode.appendChild(error);
        valid = false;
      }
      let bdate = document.forms["regForm"]["bdate"].value;
      var date = new Date(bdate);
      if (date.getFullYear() < 1900 || date.getFullYear() > 2010) {
        document.forms["regForm"]["bdate"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "You're out of date";
        document.forms["regForm"]["bdate"].parentNode.appendChild(error);
        valid = false;
      }
      let fcode = document.forms["regForm"]["fcode"].value;
      if (!/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/.test(fcode)) {
        document.forms["regForm"]["fcode"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "Italian fiscal code required.";
        document.forms["regForm"]["fcode"].parentNode.appendChild(error);
        valid = false;
      }
      break;
    case 1:
      let email = document.forms["regForm"]["email"].value;
      if (!/^\S+@\S+\.\S+$/.test(email)) {
        document.forms["regForm"]["email"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "Invalid email.";
        document.forms["regForm"]["email"].parentNode.appendChild(error);
        valid = false;
      }
      let confirm_email = document.forms["regForm"]["c-email"].value;
      if (confirm_email !== email) {
        document.forms["regForm"]["c-email"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "Emails doesn't match.";
        document.forms["regForm"]["c-email"].parentNode.appendChild(error);
        valid = false;
      }
      let password = document.forms["regForm"]["pword"].value;
      if (password.length < 8) {
        document.forms["regForm"]["pword"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "Password lenght must be at least 8!";
        document.forms["regForm"]["pword"].parentNode.appendChild(error);
        valid = false;
      }
      let confirm_password = document.forms["regForm"]["c-pword"].value;
      if (confirm_password !== password) {
        document.forms["regForm"]["c-pword"].className += " invalid";
        var error = document.createElement("span");
        error.className = "invalid-feedback";
        error.innerHTML = "Password doesn't match.";
        document.forms["regForm"]["c-pword"].parentNode.appendChild(error);
        valid = false;
      }
      break;
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function addErrorMessage() {
  if (y[i].value == "") {
    y[i].className += " invalid";
    // add an error message
    var error = document.createElement("span");
    error.className = "invalid-feedback";
    error.innerHTML = "This field is required.";
    y[i].parentNode.appendChild(error);
    valid = false;
  } else {
    //...
  }
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i,
    x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

function signup() {
  let fn = document.forms["regForm"]["fname"].value;
  let ln = document.forms["regForm"]["lname"].value;
  let bd = document.forms["regForm"]["bdate"].value;
  let fc = document.forms["regForm"]["fcode"].value;
  let aa = document.forms["regForm"]["address"].value;
  let ph = document.forms["regForm"]["phone"].value;
  let em = document.forms["regForm"]["email"].value;
  let pw = document.forms["regForm"]["pword"].value;

  let formData = new FormData();
  formData.append("name", fn);
  formData.append("surname", ln);
  formData.append("birthDate", bd);
  formData.append("gender", 1);
  formData.append("townId", aa);
  formData.append("email", em);
  formData.append("phone", ph);
  formData.append("password", pw);
  formData.append("taxId", fc);

  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../api/insert_user.php");

  xhttp.onreadystatechange = async function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "1") {
        await addPreferences();
        window.location.href = "../pages/home.php";
      } else {
        alert(this.responseText);
      }
    }
  };

  xhttp.send(formData);
}

async function addPreferences() {
  var input = document.getElementsByName("sport[]");
  var ris = [];
  for (var i = 0; i < input.length; i++) {
    if (input[i].checked) {
      ris.push(input[i].value);
    }
  }
  try {
    var uId = await getLastUserId();
    console.log(`Ultimo ID utente inserito: ${uId}`);
  } catch (error) {
    console.error(error);
  }

    // var uId = await getLastUserId()
    //   .then((lastUserId) => {
    //     console.log(`Ultimo ID utente inserito: ${lastUserId}`);
    //   })
    //   .catch((error) => {
    //     console.error(error);
    //   });

  console.log(uId);
  for (var i = 0; i < ris.length; i++) {
    let formData = new FormData();
    formData.append("activity", ris[i]);
    formData.append("user", uId);
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

async function getLastUserId() {
  try {
    const response = await fetch('../api/lastId_user.php');
    const data = await response.json();
    console.log(data);
    return data;

  } catch (error) {
    console.error(error);
    return -3; // oppure un valore di default diverso

  }
}


function login() {
  let em = document.forms["regForm"]["email"].value;
  let pw = document.forms["regForm"]["pword"].value;

  let formData = new FormData();
  formData.append("email", em);
  formData.append("password", pw);

  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../api/login_user.php");

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "1") {
        window.location.href = "../pages/home.php";
      } else {
        console.log(this.responseText);
        alert(this.responseText);
      }
    }
  };

  xhttp.send(formData);
}
*/