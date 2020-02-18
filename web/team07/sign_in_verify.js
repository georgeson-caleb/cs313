function submitInfo() {
   var formData = new FormData();
   var username = document.getElementById("username").value;
   var password = document.getElementById("password").value;

   formData.append("username", username);
   formData.append("password", password);

   $.ajax({
      url: "verify_credentials.php",
      type: "POST",
      processData: false,
      contentType: false,
      data: formData,
      complete : function(response) {
         console.log("response: " + JSON.stringify(response));
         document.getElementById("error").innerHtml = response.responseText;
         document.getElementById("error").style.display = "block";
      }
   });
}