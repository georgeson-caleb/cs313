<?php 
   require("dbConnect.php");

   session_start(); 

   $db = get_db();

   $username = strip_tags($_POST["username"]);
   $password = strip_tags($_POST["password"]);
   $query = "SELECT pass, id FROM users WHERE username=:username";
   $stmt = $db->prepare($query);
   $stmt->bindValue(":username", $username, PDO::PARAM_STR);
   $stmt->execute();

   $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($userInfo) > 1) {
      #something is wrong. there should only be 1
   } else if (count($userInfo) == 0) {
      # Invalid username
      echo "no";
   } else {
      # check the password
      if (password_verify($password, $userInfo[0]["pass"])) {
        $_SESSION["dq4r1"] = $userInfo[0]["id"];
         ob_clean();
         header("Location: https://fast-eyrie-52386.herokuapp.com/catscratch/home.php");
         exit();
      } else {
         # send password error message
         echo "no";
      }
   }
   
?>