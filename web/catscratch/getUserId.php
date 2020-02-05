<?php 
   require("dbConnect.php");
   function getUserId($username) {
      $db = get_db();

      $stmt = $db->prepare("SELECT id FROM users WHERE username=:username");
      $stmt->bindValues(':username', $username, PDO::PARAM_STR);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
   }
?>