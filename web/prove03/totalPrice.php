<?php 

   session_start();

   $totalPrice = 0;

   foreach($SESSION["cart"] as $item) {
      $totalPrice += $item->price;
   }

   echo $totalPrice;
?>