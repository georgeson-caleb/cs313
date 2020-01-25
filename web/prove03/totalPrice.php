<?php 

   session_start();

   $totalPrice = 0;

   foreach($SESSION["cart"] as $item) {
      $totalPrice += floatval($item->price);
   }

   echo($totalPrice);
?>