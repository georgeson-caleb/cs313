<?php
   require("dbConnect.php");
   $db = get_db();
   
   session_start();
   if ($_SESSION["dq4r1"] == "") {
      // Not logged in
      echo "not logged in";
   } else {

   }
?>

<!DOCTYPE html>
<html>
<head>
   <title> Catscratch - Share your kitties!</title>
   <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="script.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <header id="top">
      <h1>Catscratch</h1>
   </header>
   
   </div>
   <h3 class="text-center">Add a cat</h3>
   <div id="info-box" class="d-flex flex-wrap w-75 mx-auto mb-2 p-2 border rounded">
      <label for="name">Cat's name:</label>
      <input type="text" id="name">
      <label for="age">Age (years):</label>
      <input type="number" id="age">
      <label for="image">Picture:</label>
      <input type="file" accept="image/*" id="image">
      <image src="#" class="d-none">
      <button type="button" onclick="uploadImg()">Submit</button>
   </div>
   <div id="response"></div>
</body>
</html>