<?php 

   require("dbConnect.php");

   $username = strip_tags($_POST["username"]);
   $email = strip_tags($_POST["email"]);
   $password = strip_tags($_POST["password"]);

   $tater = password_hash($password, PASSWORD_BCRYPT);

   $db = get_db();

   $query = "INSERT INTO users (username, email, pass) VALUES ($username, $email, $tater);";

   $stmt = $db->prepare($query);
   $stmt->execute();
?>