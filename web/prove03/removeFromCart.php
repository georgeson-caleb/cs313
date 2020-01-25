<?php
   session_start();

   $index = 0;

   for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
      if ($_SESSION["cart"][i]->name == $_POST["item"]) {
         $index = $i;
      } 
   }
   
   $_SESSION["totalPrice"] -= $_SESSION["cart"][i]->price;
   array_splice($_SESSION["cart"], $index);
?>