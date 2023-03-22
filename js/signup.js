var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
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
  var x, y, i, valid = true;
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
  var i, x = document.getElementsByClassName("step");
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

      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              if (this.responseText == "1"){
                  alert("L'utente è stato inserito correttamente");
                  window.location.href = '../pages/home.php';
              } else {
                  alert(this.responseText);
              }
          }
      };

      xhttp.send(formData);

}