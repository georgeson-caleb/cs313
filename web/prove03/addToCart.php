<?php 

   array_push($_SESSION["cart"], json_decode($_POST["item"]));

   echo(json_encode($_SESSION["cart"]));

?>