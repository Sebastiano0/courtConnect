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
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
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
  let pw = document.forms["regForm"]["password"].value;

  if (pw != cpw) {
      alert("Le due password non corrispondono");
  } else {
      let formData = new FormData();
      formData.append("name", fn);
      formData.append("surname", ln);
      formData.append("birthDate", bd);
      formData.append("gender", fc);
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

}