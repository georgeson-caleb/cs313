function signup() {
   var inputValid = true;
   var username = document.getElementById("usernameSignup").value;
   var email = document.getElementById("email").value;
   var password1 = document.getElementById("password1").value;
   var password2 = document.getElementById("password2").value;

   if (/ /.test(username)) {
      showError("usernameSignupError", "* No spaces in username.");
      inputValid = false;
   } else if (username == "") {
      showError("usernameSignupError", "* Required field");
      inputValid = false;
   } else {
      disableError("usernameSignupError");
      inputValid = inputValid & true;
   }

   if (!/@/.test(email)) {
      showError("emailError");
      inputValid = false;
   } else if (email == "") {
      showError("emailError", "* Required field");
      inputValid = false;
   } else {
      disableError("emailError");
      inputValid = inputValid & true;
   }

   if (password1 != password2) {
      showError("passwordError", "* Passwords must match.");
      inputValid = false;
   } else if (password1 == "") {
      showError("passwordError", "* Required field");
      inputValid = false;
   } else {
      disableError("passwordError");
      inputValid = inputValid & true;
   }

   if (inputValid) {
      submitSignupInfo(username, email, password1);
   }
}

function showError(id, message) {
   document.getElementById(id).innerHTML = message;
   document.getElementById(id).style.display = "block";
}

function disableError(id) {
   document.getElementById(id).style.display = "none";
}

function submitSignupInfo(username, email, password) {
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         console.log(this.responseText);
      }
   }

   xhttp.open("POST", "submitSignup.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
   xhttp.send("username=" + username + "&email=" + email + "&password=" + password);
}