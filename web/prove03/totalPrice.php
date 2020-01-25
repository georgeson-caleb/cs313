<?php 

   session_start();

   $totalPrice = 0;

   foreach($_SESSION["cart"] as $item) {
      $totalPrice += floatval($item->price);
   }

   echo($totalPrice);
?>