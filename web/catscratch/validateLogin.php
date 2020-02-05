<?php 
   require("dbConnect.php");
   require("getUserId.php");

   session_start(); 

   $db = get_db();

   $username = strip_tags($_POST["username"]);
   $password = strip_tags($_POST["password"]);
   $query = "SELECT pass FROM users WHERE username=:username";
   $stmt = $db->prepare($query);
   $stmt->bindValue(":username", $username, PDO::PARAM_STR);
   $stmt->execute();

   $hash = $stmt->fetchAll(PDO::FETCH_ASSOC);

   echo json_encode($hash);

   if (count($hash) > 1) {
      #something is wrong. there should only be 1
   } else if (count($hash) == 0) {
      # Invalid username
      echo "no";
   } else {
      # check the password
      if (password_verify($password, $hash[0]["pass"])) {
         $_SESSION["dq4r1"] = getUserId($username);
         ob_clean();
         header("Location: home.php");
         exit();
      } else {
         # send password error message
         echo "no";
      }
   }
   
?>