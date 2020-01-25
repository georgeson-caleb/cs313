<?php
   session_start();

   $index;
   $totalPrice = 0;

   for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
      if ($_SESSION["cart"][i]->name == $_POST["item"]) {
         $index = $i;
      } else {
         $totalPrice += floatval($_SESSION["cart"][i]->price);
      }
   }
   
   array_splice($_SESSION["cart"], $index);

   echo $totalPrice;
?>