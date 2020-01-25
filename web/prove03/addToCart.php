<?php 

   array_push($_SESSION["cart"], $_POST["item"]);

   echo(json_encode($_SESSION["cart"]));

?>