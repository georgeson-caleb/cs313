<?php
   session_start();
   
   $index = array_search(json_decode($_POST["item"]), $_SESSION["cart"]);
   array_splice($_SESSION["cart"], $index);

   echo(json_encode($_SESSION["cart"]));

?>