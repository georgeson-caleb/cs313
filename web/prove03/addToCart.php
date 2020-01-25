<?php 

   session_start();

   $item = json_decode($_POST("item"));
   if ($_SESSION["cart"] == null) {
      $_SESSION["cart"] = array($item);
   } else {
      array_push($_SESSION["cart"], $item);
   }

   $_SESSION["totalPrice"] += floatval($item->price);

?>