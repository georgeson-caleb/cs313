<?php

   $itemList = json_decode($_POST["itemList"]);
   $totalPrice = 0;

   foreach($itemList as $item) {
      $imgName = $item->name . ".png";
      $price = $item->price;

      $totalPrice += floatval($price);

      echo("<div id='$item->name' class='m-1 p-2 w-50 border rounded'><img src=$imgName class='img-fluid'><p></p><button class='btn btn-danger btn-block' onclick='removeFromCart(\"$item->name\")'>Remove from cart</button></div>");
   }

   echo("<div class='d-flex'><button class='btn float-left btn-primary' onclick='goShopping()'>Continue shopping</button><button class='btn float-right btn-primary' onclick='checkout()'>Checkout</button></div>");

?>