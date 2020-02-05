<?php 
   require("dbConnect.php");
   $db = get_db();

   $username = strip_tags($_POST["username"]);
   $password = strip_tags($_POST["password"]);
   $query = "SELECT pass FROM users WHERE username=:username";
   $stmt = $db->prepare($query);
   $stmt->bindValue(":username", $username, PDO::PARAM_STR);
   $stmt->execute();

   $hash = stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($hash) > 1) {
      #something is wrong. there should only be 1
   } else if (count($hash) == 0) {
      # Invalid username
      echo "something wrong";
   } else {
      # check the password
      if (password_verify($password, $hash["pass"])) {
         echo "logging in...";
      } else {
         # send password error message
         echo "invalid";
      }
   }
   
?>