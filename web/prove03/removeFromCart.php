<?php
   session_start();

   $index;

   for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
      if ($_SESSION["cart"][i]->name == $_POST["item"]) {
         $index = $i;
      }
   }
   
   array_splice($_SESSION["cart"], $index);
?>