<?php 

   session_start();
   
   if ($_SESSION["cart"] == null) {
      $_SESSION["cart"] = array(json_decode($_POST["item"]));
   } else {
      array_push($_SESSION["cart"], json_decode($_POST["item"]));
   }

   echo(json_encode($_SESSION["cart"]));

?>