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
         processSignUpResponse(this.responseText);
      }
   }

   xhttp.open("POST", "submitSignup.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
   xhttp.send("username=" + username + "&email=" + email + "&password=" + password);
}

function processSignUpResponse(response) {
   var obj = JSON.parse(response);
   if (!obj.uservalid) {
      showError("usernameSignupError", "Username has already been taken");
   } else {
      disableError("usernameSignupError");
   }

   if (!obj.emailvalid) {
      showError("emailError", "Email has already been used with another account.");
   } else {
      disableError("emailError");
   }

   if (obj.uservalid && obj.emailvalid) {
      window.location.href = "https://fast-eyrie-52386.herokuapp.com/catscratch/home.php";
   }
}

function login() {
   var username = document.getElementById("username").value;
   var password = document.getElementById("password").value;

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         processLogin(this.responseText);
      }
   }
   xhttp.open("POST", "validateLogin.php", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("username=" + username + "&password=" + password);
}

function processLogin(success) {
   if (success) {
      window.location.href = "https://fast-eyrie-52386.herokuapp.com/catscratch/home.php";
   } else {
      showError("loginError", "Invalid credentials.");
   }
}


// Based on code found here: https://stackoverflow.com/questions/19617996/file-upload-without-form
function uploadImg() {
   var pictureInput = document.getElementById("image");

   var myFormData = new FormData();
   myFormData.append('image', pictureInput.files[0]);

   var response = '';

   $.ajax({
      url: 'upload.php',
      type: 'POST',
      processData: false, // important
      contentType: false, // important
      dataType : 'json',
      data: myFormData , 
      done : function(text) {
         response = text;
         console.log(response);
      document.getElementById("add-image").innerHTML += response;
      } , 
      fail : function() {
         console.log("something went wrong");
      }
   });
}



