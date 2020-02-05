<?php
   session_start();
   echo "logged in";
?>

<!DOCTYPE html>
<html>
<head>
   <title> Catscratch - Share your kitties!</title>
</head>
<body>
   <h1>Catscratch</h1>
   <?php
      if ($_SESSION["dq4r1"] == "") {
         echo "not logged id";
      } else {
         echo "logged in";
      }
   ?>
</body>
</html>